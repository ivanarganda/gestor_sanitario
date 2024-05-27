<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $pages_pagination = 3;

    // Function to send data by email both request, warnings, forward, etc...
    public function send( $data ){
        return view( 'send' , ['data' => $data] );
    }

    public function generatePagination( $data ){
        $extraParams = '';
        if ( isset($_GET['s']) ){
            $extraParams = '&s=' . $_GET['s'];
        }
        return "
        <style>
                /* Estilos para animar los botones de paginación */
            .pagination a {
                display: inline-block;
                padding: 0.5rem 1rem;
                margin: 0 0.25rem;
                border-radius: 0.375rem;
                background-color: #f3f4f6;
                color: #374151;
                font-weight: 500;
                transition: background-color 0.2s ease, color 0.2s ease;
            }
            .pagination a:hover {
                background-color: #3b82f6;
                color: #ffffff;
            }
            .pagination .active a {
                background-color: #3b82f6;
                color: #ffffff;
            }

            .pagination-link {
                display: inline-block;
                padding: 0.5rem 1rem;
                margin: 0 0.25rem;
                border-radius: 0.375rem;
                background-color: #f3f4f6;
                color: #374151;
                font-weight: 500;
                transition: background-color 0.2s ease, color 0.2s ease, transform 0.2s ease;
                text-decoration: none;
            }

            .pagination-link:hover {
                background-color: #3b82f6;
                color: #ffffff;
                transform: scale(1);
            }

            .pagination-link.active {
                background-color: #3b82f6;
                color: #ffffff;
            }

            .pagination-link.disabled {
                background-color: #e5e7eb;
                color: #9ca3af;
                cursor: not-allowed;
            }
        </style>
        <nav role='navigation' aria-label='pagination' class='mx-auto flex w-full justify-center mt-6'>
            <ul class='flex flex-row items-center gap-1'>
                <!-- Previous page link -->
                <li>
                    <a href='{$data->previousPageUrl()}{$extraParams}' class='pagination-link" . ($data->onFirstPage() ? ' disabled' : '') . "'>&laquo; Previous</a>
                </li>
                <!-- Pagination elements -->
                " . implode('', array_map(function($i) use ($data , $extraParams) {
                    return "
                        <li>
                            <a href='{$data->url($i)}{$extraParams}' class='pagination-link" . ($i == $data->currentPage() ? ' active' : '') . "'>$i</a>
                        </li>";
                }, range(1, $data->lastPage()))) . "
                <!-- Next page link -->
                <li>
                    <a href='{$data->nextPageUrl()}{$extraParams}' class='pagination-link" . ($data->hasMorePages() ? '' : ' disabled') . "'>Next &raquo;</a>
                </li>
            </ul>
        </nav>
        ";
        
    }

    public function getCurrentProtocol(){
         // Check if the HTTPS key is set and is 'on' or '1'
        if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] === 'on' || $_SERVER['HTTPS'] == 1)) {
            return 'https';
        }
        // If not, default to 'http'
        return 'http';
    }

    public function registerSession( $data ){
        DB::table('sessions')->insert( $data );
    }

    public function registerUser( $data ){
        DB::table('users')->insert( $data );
    }
    public function sendMessage( $data ){
        DB::table('chatnotificationsrequest')->insert( $data );
    }
    public function getAdministratorsEmail(){
        $results = DB::table('administrators')->get();
        return $results;
    }

    public function getSessions_view( $search ){
        $query = DB::table('users as u')
            ->leftJoin('sessions as s', 'u.id', '=', 's.user_id')
            ->select(
                'u.name as name', 
                's.ip_address as ip_address', 
                's.login_time as login_time', 
                's.logout_time as logout_time', 
                DB::raw('
                CASE s.status
                    WHEN "1" THEN "Exitosa"
                    WHEN "0" THEN "Fallida"
                    ELSE s.status
                END as status
            '));

        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->orWhere('s.id', 'like', '%' . $search . '%')
                    ->orWhere('s.ip_address', 'like', '%' . $search . '%')
                    ->orWhere('s.status', 'like', '%' . $search . '%');
            });
        }
        
        $results = $query->paginate(5);

        return $results;
    }

    public function getUsers_view( $search ){
        $query = DB::table('users');
        
        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->orWhere('id', 'like', '%' . $search . '%')
                    ->orWhere('role', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('colegiate', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }

        $results = $query->paginate( 5 );
        return $results;
    }

    public function getNotificationsByAdmin( $id ){

        $results = DB::table(DB::raw("(SELECT a.id AS administrator_id, a.name AS administrator_name, a.email AS administrator_email 
                              FROM requestnotifications rn 
                              LEFT JOIN administrators a ON rn.destinatary = a.id WHERE a.id = $id AND rn.viewed = '0') AS Q1"))
            ->select(DB::raw("CONCAT(Q1.administrator_email, '(', Q1.administrator_email, ')') AS administrator_fullname"))
            ->selectRaw("COUNT(*) AS notifications")
            ->groupBy('Q1.administrator_id')
            ->get();

        return $results;

    }

    public function getNotificationsByAdmin_view($search, $id) {
        // Ensure pages_pagination is defined
        $this->pages_pagination = 15; // Example value, adjust as needed
    
        $query = DB::table('users as u')
        ->leftJoin('requestnotifications as rn', 'u.id', '=', 'rn.emisor')
        ->select(
            'u.name as emisor_user',
            'u.role as role_user',
            'u.email as emisor_email',
            'rn.id as request_id',
            'rn.emisor as emisor',
            'rn.rubbised as rubbised',
            DB::raw('
                CASE rn.request_type
                    WHEN "change_password" THEN "cambiar contraseña"
                    WHEN "change_name_user" THEN "cambiar usuario"
                    WHEN "change_role" THEN "cambiar grupo"
                    ELSE rn.request_type
                END as request_type
            '),
            'rn.title as request_title',
            'rn.description as description',
            'rn.created_at as created_at',
            'rn.status as status',
            'rn.viewed as viewed',
            'rn.rubbised as recycled'
        )
        ->where('rn.destinatary', $id);

    
        // Add the search filter if the search parameter is set
        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->orWhere('u.name', 'like', '%' . $search . '%')
                    ->orWhere('u.role', 'like', '%' . $search . '%')
                    ->orWhere('u.email', 'like', '%' . $search . '%')
                    ->orWhere('rn.title', 'like', '%' . $search . '%')
                    ->orWhere('rn.status', 'like', '%' . $search . '%')
                    ->orWhere('rn.description', 'like', '%' . $search . '%');
            });
        }
    
        $results = $query->paginate($this->pages_pagination);
    
        return $results;
    }
    

    public function getMyRequestes_view( $search , $id)
    {

        $query = DB::table('users as u')
        ->leftJoin('requestnotifications as rn', 'u.id', '=', 'rn.emisor')
        ->leftJoin('chatnotificationsrequest as cr', 'cr.request_id', '=', 'rn.id')
        ->select(
            'u.name as emisor_user',
            'u.email as emisor_email',
            'u.role as role_user',
            'rn.id as request_id',
            'rn.emisor as emisor',
            'rn.destinatary as destinatary',
            DB::raw('(select a.name from administrators a where a.id = rn.destinatary) as administrator_name'),
            DB::raw('(select a.email from administrators a where a.id = rn.destinatary) as administrator_email'),
            DB::raw('
                CASE rn.request_type
                    WHEN "change_password" THEN "cambiar contraseña"
                    WHEN "change_name_user" THEN "cambiar usuario"
                    WHEN "change_role" THEN "cambiar grupo"
                    ELSE rn.request_type
                END as request_type
            '),
            'rn.title as request_title',
            'rn.description as description',
            'rn.created_at as created_at',
            'rn.status as status',
            'rn.viewed as viewed'
        )
        ->addSelect(DB::raw("(
            SELECT COUNT(*)
            FROM chatnotificationsrequest cr2
            WHERE cr2.request_id = rn.id
        ) AS messages_chat"))
        ->where('rn.emisor', $id);

        // Add the search filter if the search parameter is set
        // Get the search parameter if it's set
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('rn.id', 'like', '%' . $search . '%')
                    ->orWhere('u.name', 'like', '%' . $search . '%')
                    ->orWhere('u.email', 'like', '%' . $search . '%')
                    ->orWhere('rn.title', 'like', '%' . $search . '%')
                    ->orWhere('rn.status', 'like', '%' . $search . '%')
                    ->orWhere('rn.description', 'like', '%' . $search . '%');
            });
        }

        // Paginate the results
        $results = $query->paginate($this->pages_pagination);

        return $results;
    }

    public function getDetailsNotification( $id ){
        $results = DB::table('users as u')
        ->leftJoin('requestnotifications as rn', 'u.id', '=', 'rn.emisor')
        ->select(
            'u.name as emisor_user',
            'u.email as emisor_email',
            'rn.id as request_id',
            'rn.emisor as emisor',
            'rn.request_type as request_type',
            'rn.title as request_title',
            'rn.description as description',
            'rn.created_at as created_at',
            'rn.status as status',
            'rn.rubbised as recycled'
        )
        ->where('rn.id', $id)
        ->get();
        
        return $results;
    }

    public function getChatList( $id ){
        $destinataryChats = DB::table('chatnotificationsrequest')
            ->select('destinatary')
            ->distinct()
            ->where('emisor', $id);

        // Main query
        $results = DB::table(DB::raw('(' . $destinataryChats->toSql() . ') as dc'))
            ->select(
                'dc.destinatary', 
                'cr.message as last_message',
                DB::raw('(select u.name from users u where u.id = dc.destinatary) as user_destinatary'),
                DB::raw('(select u.email from users u where u.id = dc.destinatary) as email_destinatary'),
                'cr.created_at as last_message_date')
            ->join(DB::raw('LATERAL (
                SELECT cr.message, cr.created_at
                FROM chatnotificationsrequest cr
                WHERE cr.destinatary = dc.destinatary
                ORDER BY cr.created_at DESC
                LIMIT 1
            ) as cr'), DB::raw('1'), '=', DB::raw('1'))
            ->mergeBindings($destinataryChats) // Merge bindings from the subquery
            ->get();

        return $results;
    }

    public function getChatRoom( $emisor , $destinatary ){

        $results = DB::table('chatnotificationsrequest as cr')
        ->rightJoin('requestnotifications as rn', 'rn.id', '=', 'cr.request_id')
        ->rightJoin('users as u', 'u.id', '=', 'rn.emisor')
        ->select(
            DB::raw('(select u2.name from users u2 where u2.id = cr.destinatary) as user_destinatary'),
            DB::raw('(select u2.email from users u2 where u2.id = cr.destinatary) as email_destinatary'),
            'cr.*',
            'u.name as emisor_name',
            'u.email as emisor_email'
        )
        ->where(function($query) use ($emisor, $destinatary) {
            $query->where('cr.emisor', $emisor)
                ->where('cr.destinatary', $destinatary);
        })
        ->orWhere(function($query) use ($emisor, $destinatary) {
            $query->where('cr.emisor', $destinatary)
                ->where('cr.destinatary', $emisor);
        })
        ->get();

        return $results;

    }
    
}
