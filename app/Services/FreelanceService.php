<?php

namespace App\Services;

use App\Models\KerjaSama;
use App\Models\Notification;
use App\Models\Pekerjaan;
use App\Models\RatingUser;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class FreelanceService
{
    private const DEFAULT_AVATAR = 'https://ui-avatars.com/api/?name=User&background=FFE600&color=000&bold=true';

    public function getFreelancers(?string $search = null): \Illuminate\Database\Eloquent\Collection
    {
        $query = User::select('id', 'name', 'profil_picture', 'keahlian', 'deskripsi', 'rating', 'nohp')
            ->whereNotNull('email');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                    ->orWhere('keahlian', 'like', '%'.$search.'%')
                    ->orWhere('deskripsi', 'like', '%'.$search.'%');
            });
        }

        return $query->get()->map(function ($user) {
            $user->profil_picture = $this->getProfilePictureUrl($user->profil_picture, $user->name);

            return $user;
        });
    }

    private function getProfilePictureUrl(?string $path, ?string $name = null): string
    {
        if (empty($path)) {
            return self::DEFAULT_AVATAR.'&name='.urlencode($name ?? 'User');
        }

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        $fullPath = public_path('images/'.$path);
        if (file_exists($fullPath)) {
            return asset('images/'.$path);
        }

        return self::DEFAULT_AVATAR.'&name='.urlencode($name ?? 'User');
    }

    public function getJobsByMitra(int $mitraId): \Illuminate\Database\Eloquent\Collection
    {
        return Pekerjaan::where('id_mitra', $mitraId)
            ->select('id', 'nama_lowongan', 'jenis_lowongan', 'gaji_minimal', 'gaji_maksimal', 'deskripsi', 'foto', 'status')
            ->get()
            ->map(function ($job) {
                $job->foto = $this->getJobPhotoUrl($job->foto, $job->nama_lowongan);

                return $job;
            });
    }

    private function getJobPhotoUrl(?string $path, ?string $title = null): string
    {
        if (empty($path)) {
            return 'https://ui-avatars.com/api/?name='.urlencode($title ?? 'Job').'&background=000&color=fff&bold=true';
        }

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        $fullPath = public_path('images/'.$path);
        if (file_exists($fullPath)) {
            return asset('images/'.$path);
        }

        return 'https://ui-avatars.com/api/?name='.urlencode($title ?? 'Job').'&background=000&color=fff&bold=true';
    }

    public function offerJob(int $userId, int $mitraId, int $pekerjaanId): bool
    {
        try {
            KerjaSama::create([
                'id_user' => $userId,
                'id_mitra' => $mitraId,
                'id_pekerjaan' => $pekerjaanId,
                'status' => 'menunggu',
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to offer job: '.$e->getMessage());

            return false;
        }
    }

    public function getFreelancerDetail(int $id): User
    {
        return User::findOrFail($id);
    }

    public function getFreelancerRatings(int $userId): \Illuminate\Database\Eloquent\Collection
    {
        return RatingUser::where('id_user', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function submitRating(int $userId, int $mitraId, array $ratings, ?string $comment, ?array $tags): void
    {
        $totalRating = ($ratings['quality'] + $ratings['communication'] + $ratings['timeliness']) / 3;

        RatingUser::create([
            'id_user' => $userId,
            'rating' => $totalRating,
            'komentar' => $comment,
            'tag' => $tags ? implode(',', $tags) : null,
        ]);

        $this->updateUserAverageRating($userId);
    }

    private function updateUserAverageRating(int $userId): void
    {
        $user = User::find($userId);
        if ($user) {
            $user->rating = RatingUser::where('id_user', $userId)->avg('rating');
            $user->save();
        }
    }

    public function getUnreadNotificationCount(int $mitraId): int
    {
        return Notification::where('id_mitra', $mitraId)
            ->where('status', 'unread')
            ->count();
    }

    public function getMitraById(int $mitraId): ?Mitra
    {
        return Mitra::find($mitraId);
    }
}
