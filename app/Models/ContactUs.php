<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactUs
 *
 * @property int $id
 * @property string $user_mobile
 * @property string $title
 * @property string $content
 * @property int $status
 * @property Carbon $created_at
 *
 * @property User $user
 *
 * @package App\Models
 */
class ContactUs extends Model
{
	protected $table = 'contact_us';
	public $timestamps = true;
	public static $snakeAttributes = false;

	protected $fillable = [
		'user_id',
        'mobile',
		'title',
		'content',
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}
}
