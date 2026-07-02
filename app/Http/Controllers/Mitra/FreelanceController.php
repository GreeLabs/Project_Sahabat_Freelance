<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Services\FreelanceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class FreelanceController extends Controller
{
    public function __construct(
        private FreelanceService $freelanceService
    ) {}

    public function index()
    {
        $mitra = Auth::guard('mitra')->user();
        $idMitra = $mitra->id;

        $users = $this->freelanceService->getFreelancers(request('search'));
        $data = $this->freelanceService->getJobsByMitra($idMitra);
        $unreadNotificationsCount = $this->freelanceService->getUnreadNotificationCount($mitra->id);

        return view('pages.mitra.freelance', compact('users', 'data', 'unreadNotificationsCount'));
    }

    public function tawarkanPekerjaan(Request $request)
    {
        $idMitra = Auth::guard('mitra')->user()->id;
        $result = $this->freelanceService->offerJob(
            $request->input('id_user'),
            $idMitra,
            $request->input('id_pekerjaan')
        );

        if ($result) {
            Alert::success('Berhasil!', 'Pekerjaan berhasil ditawarkan!');

            return redirect()->back();
        }

        Alert::error('Gagal!', 'Terjadi kesalahan, pekerjaan gagal ditawarkan.');

        return redirect()->route('mitra.job');
    }

    public function detail($id)
    {
        $freelancer = $this->freelanceService->getFreelancerDetail($id);
        $ratings = $this->freelanceService->getFreelancerRatings($id);
        $mitra = Auth::guard('mitra')->user();
        $unreadNotificationsCount = $this->freelanceService->getUnreadNotificationCount($mitra->id);

        return view('pages.mitra.detailfr', compact('freelancer', 'ratings', 'unreadNotificationsCount'));
    }

    public function submitRating(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_mitra' => 'required|exists:users,id',
            'quality' => 'required|integer|min:1|max:5',
            'communication' => 'required|integer|min:1|max:5',
            'timeliness' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'tags' => 'nullable|array',
        ]);

        $this->freelanceService->submitRating(
            $request->id_user,
            $request->id_mitra,
            [
                'quality' => $request->quality,
                'communication' => $request->communication,
                'timeliness' => $request->timeliness,
            ],
            $request->comment,
            $request->tags
        );

        return redirect()->back()->with('success', 'Rating dan komentar berhasil disimpan!');
    }
}
