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

    public function generatePagination( $data ){
        
        return "<nav role='navigation' aria-label='pagination' class='mx-auto flex w-full justify-center mt-6'>
            <ul class='flex flex-row items-center gap-1'>
                <!-- Previous page link -->
                <li>
                    <a href='{$data->previousPageUrl()}' class='pagination-link'>&laquo; Previous</a>
                </li>
                <!-- Pagination elements -->
                " . 
                implode('', array_map(function($i) use ($data) {
                    return "<li>
                                <a href='{$data->url($i)}' class='pagination-link" . ($i == $data->currentPage() ? ' active' : '') . "'>$i</a>
                            </li>";
                }, range(1, $data->lastPage()))) . "
                <!-- Next page link -->
                <li>
                    <a href='{$data->nextPageUrl()}' class='pagination-link'>Next &raquo;</a>
                </li>
            </ul>
        </nav>";

    }

    public function registerSession( $data ){
        DB::table('sessions')->insert( $data );
    }

    public function registerUser( $data ){
        DB::table('users')->insert( $data );
    }
    
}
