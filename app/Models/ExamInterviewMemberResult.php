<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamInterviewMemberResult extends Model
{
    use HasFactory;
    protected $fillable = [''];
    protected $table = 'exam_interview_member_results';
    protected $appends =['question'];
    
    public function getInterviewQuestion()
    {
        return $this->hasOne('App\Models\InterviewQuestion','id','id_interview_question');
    }

    public function getQuestionAttribute()
    {
        return $this->getInterviewQuestion->question;    
    }
}
