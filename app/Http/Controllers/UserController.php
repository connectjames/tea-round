<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    public function showAllUsers()
    {
        // Retrieve all users
        $users = User::orderBy('name', 'DESC')->get();

        return view('users.index')->with(['users' => $users]);

    }

    public function addUser()
    {
        # Instantiate a new User Model object
        $user = new User();

        # Set the parameters
        $user->title = 'Harry Potter and the Sorcerer\'s Stone';
        $user->author = 'J.K. Rowling';
        $user->published = 1997;
        $user->cover = 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg';
        $user->purchase_link = 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427';

        # Invoke the Eloquent `save` method to generate a new row in the
        $user->save();
    }

    public function updateUser()
    {
        # Find the User Model to update
        $user = User::where('id', 'LIKE', '%Scott%')->first();

        if (!$user) {
            dump("Book not found, can't update.");
        } else {
            # Change some properties
            $user->title = 'The Really Great Gatsby';
            $user->published = '2025';

            # Save the changes
            $user->save();

        }
    }

    public function deleteUser()
    {
        # Find the User Model to delete
        $user = User::where('id', 'LIKE', '%Scott%')->first();

        if (!$user) {
            dump('Did not delete- Book not found.');
        } else {
            $user->delete();
            dump('Deletion complete; check the database to see if it worked...');
        }
    }

}
