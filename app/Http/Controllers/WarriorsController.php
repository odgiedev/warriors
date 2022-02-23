<?php

namespace App\Http\Controllers;

use App\Models\Warrior;
use Exception;
use Illuminate\Http\Request;

class WarriorsController extends Controller
{
    public function doc() {
        return response()->json([
            "Routes" => [
                "GET /api/warriors" => "Show all Warriors.",
                "GET /api/warriors/id" => "Show a specific Warrior.",
                "POST /api/warriors/create" => "Create a Warrior.",
                "PUT /api/warriors/update/id" => "Modify a Warrior.",
                "DELETe /api/warriors/delete/id" => "Delete a Warrior.",
            ],

            "Warriors" => [
                "all_required" => "create, update",

                "name" => "Warrior's name, -- min: 4, max: 9",
                "class" => "Warrior's class, -- knight, mage, archer, alchemist, priest",
                "sex" => "Warrior's sex, -- male, female",
                "weapon" => [
                    "knight" => "Sword, Axe",
                    "mage" => "Staff, Wand",
                    "archer" => "Bow, Axe",
                    "alchemist" => "Potion, Mace"
                ],
                "pet" => "Warrior's pet, -- Dragon, Wolf, Eagle, Panther"
            ]
        ]);
    }

    public function getWarrior($id) {
        $warrior = Warrior::where('id', $id)->get();
        return $warrior;
    }

    public function index() {
        try {
            $allWarriors = Warrior::all();
        } catch (Exception $err) {
            return response()->json(["An error has occurred" => $err]);
        };

        return response()->json($allWarriors);
    }

    public function show($id) {
        try {
            $warrior = Warrior::find($id, 'id');

            if (!$warrior) {
                return response()->json(["An error has occurred" => "No Warrior were found with this id."]);
            }

        } catch (Exception $err) {
            return response()->json(["An error has occurred" => $err]);
        };

        return response()->json($warrior->get());
    }

    public function store(Request $req) {
        try {
            Warrior::create($req->all());

            $warriorCreated = $req->all();
        } catch (Exception $err) {
            return response()->json(["An error has occurred" => $err]);
        };

        return response()->json(["Warrior created!." => $warriorCreated]);
    }

    public function update(Request $req, $id) {
        try {
            $warrior = Warrior::find($id, 'id');
            
            if (!$warrior) {
                return response()->json(["An error has occurred" => "No Warrior were found with this id."]);
            }

            $warrior->name = $req->name;
            $warrior->class = $req->class;
            $warrior->sex = $req->sex;
            $warrior->weapon = $req->weapon;
            $warrior->pet = $req->pet;

            $warrior->save();

            $warriorUpdated = $req->all();
        } catch (Exception $err) {
            return response()->json(["An error has occurred" => $err]);
        };

        return response()->json(["Warrior updated!." => $warriorUpdated]);
    }

    public function destroy($id) {
        try {
            $warriorDeleted = $this->getWarrior($id);

            $warrior = Warrior::find($id, 'id');

            if (!$warrior) {
                return response()->json(["An error has occurred" => "No Warrior were found with this id."]);
            }

            $warrior->delete();

        } catch (Exception $err) {
            return response()->json(["An error has occurred" => $err]);
        };

        return response()->json(["Warrior deleted." => $warriorDeleted]);
    }
}
