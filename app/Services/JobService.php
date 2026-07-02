<?php

namespace App\Services;

use App\Models\Lamaran;
use App\Models\Mitra;
use App\Models\Notification;
use App\Models\Pekerjaan;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobService
{
    private const DEFAULT_JOB_IMAGE = 'https://ui-avatars.com/api/?name=Job&background=000&color=fff&bold=true';

    public function getJobs(array $filters)
    {
        $query = Pekerjaan::query()
            ->with(['mitra:id,name,rating,profil_picture'])
            ->where('status', 'aktif');

        if (! empty($filters['kategori'])) {
            $query->where('jenis_lowongan', $filters['kategori']);
        }

        if (! empty($filters['minCost'])) {
            $query->where('gaji_minimal', '>=', $filters['minCost']);
        }

        if (! empty($filters['maxCost'])) {
            $query->where('gaji_maksimal', '<=', $filters['maxCost']);
        }

        if (! empty($filters['skillSearch'])) {
            $query->where('deskripsi', 'like', '%'.$filters['skillSearch'].'%');
        }

        $sortField = match ($filters['sort'] ?? 'latest') {
            'oldest' => 'created_at',
            'lowest' => 'gaji_minimal',
            'highest' => 'gaji_minimal',
            default => 'created_at',
        };

        $sortDirection = match ($filters['sort'] ?? 'latest') {
            'lowest' => 'asc',
            default => 'desc',
        };

        return $query->orderBy($sortField, $sortDirection)->paginate(12)->through(function ($job) {
            $job->foto = $this->getJobPhotoUrl($job->foto, $job->nama_lowongan);

            return $job;
        });
    }

    private function getJobPhotoUrl(?string $path, ?string $title = null): string
    {
        if (empty($path)) {
            return self::DEFAULT_JOB_IMAGE.'&name='.urlencode($title ?? 'J');
        }

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        $fullPath = public_path('images/'.$path);
        if (file_exists($fullPath)) {
            return asset('images/'.$path);
        }

        return self::DEFAULT_JOB_IMAGE.'&name='.urlencode($title ?? 'J');
    }

    public function getJobDetail(int $id): object
    {
        $job = DB::table('pekerjaans')
            ->join('mitras', 'mitras.id', '=', 'pekerjaans.id_mitra')
            ->select('pekerjaans.*', 'mitras.name as mitra_name', 'mitras.rating as mitra_rating', 'mitras.profil_picture as mitra_photo')
            ->where('pekerjaans.id', $id)
            ->first();

        if ($job) {
            $job->foto = $this->getJobPhotoUrl($job->foto, $job->nama_lowongan);
            $job->mitra_photo = $this->getMitraPhotoUrl($job->mitra_photo, $job->mitra_name);
        }

        return $job;
    }

    private function getMitraPhotoUrl(?string $path, ?string $name = null): string
    {
        if (empty($path)) {
            return 'https://ui-avatars.com/api/?name='.urlencode($name ?? 'M').'&background=FFE600&color=000&bold=true';
        }

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        $fullPath = public_path('images/'.$path);
        if (file_exists($fullPath)) {
            return asset('images/'.$path);
        }

        return 'https://ui-avatars.com/api/?name='.urlencode($name ?? 'M').'&background=FFE600&color=000&bold=true';
    }

    public function canUserApply(int $userId): array
    {
        $user = Auth::user();

        if ($user->role === 'basic' && $user->quota_lamaran <= 0) {
            return [
                'allowed' => false,
                'message' => 'Kuota lamaran habis. Silakan upgrade akun.',
                'redirect' => route('user.dashboard'),
            ];
        }

        return ['allowed' => true];
    }

    public function applyJob(int $userId, int $jobId, string $description): Lamaran
    {
        $pekerjaan = Pekerjaan::findOrFail($jobId);

        $lamaran = Lamaran::create([
            'id_user' => $userId,
            'id_pekerjaan' => $jobId,
            'id_mitra' => $pekerjaan->id_mitra,
            'status' => 'diproses',
            'deskripsiU' => $description,
        ]);

        $this->decrementQuota();

        return $lamaran;
    }

    private function decrementQuota(): void
    {
        $user = Auth::user();
        if ($user && $user->role === 'basic') {
            $user->decrement('quota_lamaran');
        }
    }

    public function rateJob(int $jobId, int $rating, ?string $comment): void
    {
        $user = Auth::user();
        $pekerjaan = Pekerjaan::findOrFail($jobId);

        Rating::create([
            'pekerjaan_id' => $pekerjaan->id,
            'user_id' => $user->id,
            'mitra_id' => $pekerjaan->id_mitra,
            'rating' => $rating,
            'comment' => $comment,
        ]);

        $this->updateJobRating($pekerjaan->id);
        $this->updateMitraRating($pekerjaan->id_mitra);
    }

    private function updateJobRating(int $jobId): void
    {
        $pekerjaan = Pekerjaan::find($jobId);
        if ($pekerjaan) {
            $pekerjaan->rating = Rating::where('pekerjaan_id', $jobId)->avg('rating');
            $pekerjaan->save();
        }
    }

    private function updateMitraRating(int $mitraId): void
    {
        $mitra = Mitra::find($mitraId);
        if ($mitra) {
            $mitra->rating = Rating::where('mitra_id', $mitraId)->avg('rating');
            $mitra->save();
        }
    }

    public function cancelApplication(int $lamaranId): bool
    {
        $lamaran = Lamaran::find($lamaranId);

        if (! $lamaran || $lamaran->status !== 'diproses') {
            return false;
        }

        $lamaran->delete();

        return true;
    }

    public function getUserNotifications(int $userId): \Illuminate\Database\Eloquent\Collection
    {
        return Notification::where('id_user', $userId)
            ->orderBy('updated_at', 'desc')
            ->limit(3)
            ->get();
    }

    public function getActiveJobsCount(): int
    {
        return Pekerjaan::where('status', 'aktif')->count();
    }

    public function getPendingApplicationsCount(): int
    {
        return Lamaran::where('status', 'diproses')->count();
    }
}
