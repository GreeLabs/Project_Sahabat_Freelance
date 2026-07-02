<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Services\JobService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CariJobController extends Controller
{
    public function __construct(
        private JobService $jobService
    ) {}

    public function index(Request $request)
    {
        $filters = [
            'kategori' => $request->input('kategori'),
            'sort' => $request->get('sort', 'latest'),
            'minCost' => $request->get('minCost'),
            'maxCost' => $request->get('maxCost'),
            'skillSearch' => $request->get('skillSearch'),
        ];

        $user = auth()->user();
        $pekerjaans = $this->jobService->getJobs($filters);
        $notifications = $this->jobService->getUserNotifications($user->id);

        $data = array_merge(
            compact('pekerjaans', 'user', 'notifications'),
            $filters
        );

        return view('pages.user.carijob.index', $data);
    }

    public function detail($id)
    {
        $pekerjaan = $this->jobService->getJobDetail($id);
        $ratings = Rating::where('pekerjaan_id', $id)->get();
        $user = auth()->user();
        $notifications = $this->jobService->getUserNotifications($user->id);

        return view('pages.user.carijob.detail', compact('pekerjaan', 'user', 'ratings', 'notifications'));
    }

    public function lamar(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $userId = Auth::id();
        $check = $this->jobService->canUserApply($userId);

        if (! $check['allowed']) {
            Alert::html('Kuota Habis', $check['message'].' <br> <a href="'.$check['redirect'].'" class="btn btn-primary">Upgrade Akun</a>', 'warning');

            return redirect()->back();
        }

        $this->jobService->applyJob($userId, $id, $request->description);

        Alert::success('Berhasil!', 'Lamaran berhasil dikirim.');

        return redirect()->route('user.carijob');
    }

    public function rate(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:255',
        ]);

        $this->jobService->rateJob($id, $request->rating, $request->comment);

        return redirect()->back()->with('success', 'Terima kasih atas feedback Anda!');
    }

    public function batalkan($id)
    {
        $result = $this->jobService->cancelApplication($id);

        if (! $result) {
            return redirect()->back()->with('error', 'Lamaran tidak dapat dibatalkan.');
        }

        return redirect()->back()->with('success', 'Lamaran berhasil dibatalkan.');
    }
}
