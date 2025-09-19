<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Log;

use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    
    public function viewRevisions(User $user, Article $article): bool
    {     
         Log::info("Policy check", [
        'user_id'   => $user->id,
        'is_admin'  => $user->is_admin ?? null,
        'article_owner' => $article->user_id,
        ]);

        return $user->id === $article->user_id || $user->is_admin;
    }

    public function revert(User $user, Article $article): bool
    {
        return $user->id === $article->user_id || $user->is_admin;
    }

}
