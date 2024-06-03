<?php

namespace App\Http\Controllers;

use App\Http\Resources\RuleResource;
use App\Models\Book;
use App\Models\Category;
use App\Models\Race;
use App\Models\RequiredTalent;
use App\Models\Requirement;
use App\Models\Rule;
use App\Models\Talent;
use App\Models\TraitModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Meilisearch\Endpoints\Indexes;

class SearchController extends Controller
{
    /**
     * Display the first 10 of each relevant category.
     *
     */
    public function quickSearch($query)
    {
        $search_results = new \Illuminate\Database\Eloquent\Collection; //Create empty collection
        $search_results = [
            'rules' => Rule::search($query)->take(10)->get(),
            'races' => Race::search($query)->take(10)->get(),
            'talents' => Talent::search($query)->take(10)->get(),
            'requirements' => Requirement::search($query)->take(10)->get(),
            'categories' => Category::search($query)->take(10)->get(),
            'traits' => TraitModel::search($query)->take(10)->get()
        ];
        return $search_results;

    }

    /**
     * Display the first 10 of each relevant category in given genre.
     *
     */
    public function genreSearch($genre_input, $query, Request $request)
    {
        // Validate the request
        $request->validate([
            'filters.books' => 'array'
        ]);

        // Make new genre controller
        $genre_controller = new GenreController;

        // Get genres using genre controller function showName
        $genre = $genre_controller->showName($genre_input);

        // Check if there is no error, else return genre.
        if ($genre->getStatusCode() !== 200) {
            return $genre;
        }

        // get all books with the given genre id
        $ids = Book::all()->where('genre_id', $genre->getData()->id)->pluck('id');

        $book_ids = [];

        // Check if there is any filters
        if($request->filled('filters')){
            $filters = $request['filters'];

            // Check if filter has any books.
            if(isset($filters['books'])) {

                // Check if there is any books in filters
                if(count($filters['books']) > 0){
                    // return all genre book ids that exist in the filter
                    $book_ids = $ids->intersect($filters['books']);
                }
            }
        }

        $search_results = new \Illuminate\Database\Eloquent\Collection; //Create empty collection
        // Make sure to add values() to rearrange everything properly
        $search_results = [
            // TODO: get search results to work with pivot tables
            'filters' => $request->filters,
            'book_ids' => $book_ids,
            'rules' => Collect(RuleResource::collection(Rule::search($query)->take(10)->get()))->where(function ($whereQuery) use ($book_ids){
                // TODO: fix rules pivot table search function

                error_log($whereQuery->get()->pluck('book_rules'));

                $whereQuery->select('book_rules')->from('rules');

                /* Get the pivot tables through book_rules
                $books_rules = $whereQuery->get()->pluck('book_rules');
                */

                // error_log($books_rules);

                $matching_rules = [];

                /*
                for($i=0; $i<count($books_rules); $i++){
                    // error_log($books_rules[$i]);

                    // check the pivot table against the book_ids for any match
                    $matching_rules = $books_rules[$i]->whereIn('id', $book_ids);
                    //error_log($matching_rules);
                }
                */

                /* If there is any matches return true
                if(count($matching_rules) > 0){
                    return $whereQuery;
                }
                return $whereQuery = [];
                */
            }),
            //'rules' => Rule::search($query)->take(10)->get()->whereIn('book_rules', $books)->values(),
            'races' => Race::search($query)->take(10)->get()->whereIn('book_id', $book_ids)->values(),
            'talents' => Talent::search($query)->take(10)->get()->whereIn('book_id', $book_ids)->values()
        ];
        return $search_results;
    }
}
