<?php

namespace App\Http\Controllers;

use App\Http\Requests\TalentRequest;
use App\Http\Resources\TalentResource;
use App\Models\Book;
use App\Models\Category;
use App\Models\Genre;
use App\Http\Resources\GenreResource;
use App\Models\Talent;
use http\Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Exceptions\MissingAbilityException;
use function Clue\StreamFilter\remove;

class TalentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TalentResource::collection(Talent::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TalentRequest $request)
    {
        $talent = Talent::create($request->all());

        return new TalentResource($talent);
    }

    /**
     * Display the specified resource.
     */
    public function show(Talent $talent)
    {
        return new TalentResource($talent);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Talent $talent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TalentRequest $request, Talent $talent)
    {
        $talent->update($request->all());

        if ($request->filled('categories') ||
            $request->filled('requirements') ||
            $request->filled('required_talents' ||
                $request->filled('traits'))) {
            $this->updateRelations($request, $talent);
        }

        return new TalentResource($talent);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Talent $talent)
    {
        $talent->delete();

        return response()->json(["Talent deleted"]);
    }

    /* Custom Functions */

    /**
     * Update talent
     */
    public function updateRelations(Request $request, Talent $talent)
    {
        // get the talent with given id
        $t = Talent::find($talent->id);

        // Get all the associated data input
        $categories = $request->collect('categories')->toArray();
        $requirements = $request->collect('requirements')->toArray();
        $required_talents = $request->collect('required_talents')->toArray();
        $traits = $request->collect('traits')->toArray();

        // Sync the new associated data
        $t->talent_categories()->sync($categories);
        $t->talent_requirements()->sync($requirements);
        $t->required_talents()->sync($required_talents);
        $t->talent_traits()->sync($traits);
    }

    /**
     * Display talents by genre name.
     */
    public function getTalentsByGenre($genre_input)
    {
        // Make new genre controller
        $genre_controller = new GenreController;

        // Get genres using genre controller function showName
        $genre = $genre_controller->showName($genre_input);

        // Check if there is no error, else return genre response.
        if ($genre->getStatusCode() !== 200) {
            return $genre;
        }

        // get all books with the given genre id
        $book_ids = Book::all()->where('genre_id', $genre->getData()->id)->pluck('id');

        // get all talents from the books with the given genre id
        $talents = Talent::all()->whereIn('book_id', $book_ids);

        // return the array with the talent resource
        return TalentResource::collection($talents);
    }

    /**
     * Display talent by genre name and talent id.
     */
    public function getTalentByGenre($genre_input, Talent $talent)
    {
        // Make new genre controller
        $genre_controller = new GenreController;

        // Get genres using genre controller function showName
        $genre = $genre_controller->showName($genre_input);

        // Check if there is no error, else return genre response.
        if ($genre->getStatusCode() !== 200) {
            return $genre;
        }

        // Get the book id the talent is in
        $book_id = [$talent->book_id];

        // Get the genre_id of the book
        $genre_id = Book::whereIn('id', $book_id)->get()->pluck('genre_id');

        if ($genre_id[0] === $genre->getData()->id) {
            return new TalentResource($talent);
        }
        return response()->json(['message' => 'could not find talent in given genre'], 404);
    }
}
