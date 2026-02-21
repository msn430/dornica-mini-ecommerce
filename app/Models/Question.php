<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 * 
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class Question extends Model
{
	protected $table = 'questions';
	public $timestamps = false;
	public static $snakeAttributes = false;

	protected $fillable = [
		'question',
		'answer'
	];
}
