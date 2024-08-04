<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $size = $request->query('size', 9);
        $order = $request->query('order', -1);

        $orderColumn = '';
        $orderValue = '';

        switch ($order) {
            case 1:
                $orderColumn = "created_at";
                $orderValue = 'DESC';
                break;
            case 2:
                $orderColumn = "created_at";
                $orderValue = 'ASC';
                break;
            case 3:
                $orderColumn = "status";
                $orderValue = 'ASC';
                break;
                // case 3:
                //     $orderColumn = "last_location";
                //     $orderValue = 'ASC';
                //     break;
                // case 4:
                //     $orderColumn = "last_location";
                //     $orderValue = 'DESC';
                //     break;
            default:
                $orderColumn = 'id';
                $orderValue = 'DESC';
        }

        $pets = Pet::orderBy($orderColumn, $orderValue)->simplePaginate($size);

        return view('pet.index', [
            'pets' => $pets,
            'page' => $page, 'size' => $size, 'order' => $order
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $this->retrieveUserFromRequest($request);

        $pet = $this->savePetFromRequest($request, $user->id, 'missing');

        return redirect(route('pet.report.details', $pet));
    }

    public function storeFound(Request $request): RedirectResponse
    {
        $user = $this->retrieveUserFromRequest($request);

        $pet = $this->savePetFromRequest($request, $user->id, 'found');

        return redirect(route('pet.report.details', $pet));
    }

    private function retrieveUserFromRequest(Request $request): User
    {
        $user = User::firstOrNew(
            ['email' => $request->email],
            ['name' => $request->fullname]
        );

        $user->password = Hash::make('password');
        $user->save();

        return $user;
    }

    private function savePetFromRequest(Request $request, int $reportedBy, string $status): Pet
    {
        $predictionClass = $request->species;
        $species = 'other';

        if ($predictionClass) {
            $parts = explode('-', $predictionClass);
            if (count($parts) > 0) {
                $species = $parts[0];
            }
        }

        $pet = Pet::create([
            'name' => $request->name ?? 'desconocido',
            'description' => $request->description,
            'last_location' => $request->last_location,
            'reported_by' => $reportedBy,
            'status' => $status,
            'species' => $species,
            'is_protected' => $request->is_protected ? 1 : 0,
        ]);

        $pet->addMediaFromRequest('picture')->toMediaCollection('pets');

        return $pet;
    }

    public function reportDetails(Pet $pet)
    {
        return view('pet.report-details', ['pet' => $pet]);
    }
}
