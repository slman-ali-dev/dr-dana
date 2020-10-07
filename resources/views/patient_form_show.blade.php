@extends(backpack_view('blank'))

@php

@endphp

@section('content')

<div class="container" style="direction: rtl !important;">
        <br>
            <a href="javascript: window.print();" id="btn_print" class="btn float-right"><i class="la la-print"></i></a>
            <h1 class="well">استمارة المريض</h1>
        <br>
        <div class="col-lg-12 well">
            <div class="row">
                <h3>معلومات عامة</h3>
                <hr>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>اسم المريض</label>
                            <input disabled required type="text"  value="{{ $entry->patient_name }}" name="patient_name" placeholder="ادخل الاسم هنا..." class="form-control">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>الجنس</label>
                            <input disabled required type="text"  value="{{ $entry->gender }}" name="patient_name" placeholder="ادخل الاسم هنا..." class="form-control">
                        </div>
                        <div class="col-sm-2 form-group">
                            <label>العمر</label>
                            <input disabled onkeyup="calcBMI()"  value="{{ $entry->age }}" name="age" type="number" placeholder="" class="form-control">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>العمل</label>
                            <input disabled  value="{{ $entry->job }}" name="job" type="text" placeholder="" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>رقم الهاتف</label>
                            <input disabled  value="{{ $entry->phone }}" name="phone" type="phone" placeholder="ادخل الرقم هنا..." class="form-control">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>العنوان</label>
                            <input disabled  value="{{ $entry->address }}" name="address" type="text" placeholder="" class="form-control">
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-6 form-group">
                            <label>المؤهل العلمي</label>
                            <input disabled  value="{{ $entry->qualification }}" name="qualification" type="text" placeholder="" class="form-control">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>الوضع العائلي</label>
                            <input disabled  value="{{ $entry->family_status }}" name="family_status" type="text" placeholder="" class="form-control">
                        </div>

                    </div>
                    <div id="hidden_div1" style="display: none">
                        <div class="row">

                            <div class="col-sm-6 form-group">
                                <label> عدد الاولاد</label>
                                <input disabled  value="{{ $entry->childs_no }}" name="childs_no" type="text" placeholder="" class="form-control">

                            </div>

                        </div>
                    </div>
                    <div id="hidden_div" style="display: none">
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label>الحمل</label>
                                <input disabled  value="{{ $entry->pregnant }}" name="pregnant" type="text" placeholder="" class="form-control">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>الارضاع</label>
                                <input disabled  value="{{ $entry->breastfeeding }}" name="breastfeeding" type="text" placeholder="" class="form-control">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>الدورة الشهرية</label>
                                <input disabled  value="{{ $entry->period }}" name="period" type="text" placeholder="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>أمراض السكري</label>
                            <textarea disabled  value="{{ $entry->diabetes }}" name="diabetes" type="text" rows="3" placeholder="أدخل وصفا للحالة"
                                class="form-control"></textarea>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>امراض الغدد</label>
                            <textarea disabled  value="{{ $entry->endocrine_diseases }}" name="endocrine_diseases" type="text" rows="3" placeholder="أدخل وصفا للحالة"
                                class="form-control"></textarea>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>وجود أمراض أخرى</label>
                            <textarea disabled  value="{{ $entry->other_diseases }}" name="other_diseases" type="text" rows="3" placeholder="أدخل وصفا للحالة"
                                class="form-control"></textarea>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>اجراء عمليات جراحية سابقة</label>
                            <textarea disabled  value="{{ $entry->past_surgery }}" name="past_surgery" type="text" rows="3" placeholder="أدخل وصفا للحالة"
                                class="form-control"></textarea>
                        </div>

                    </div>
                    <h3>التقييم الصحي</h3>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>الأسنان</label>
                            <input disabled  value="{{ $entry->health_assessment_teeth }}" name="health_assessment_teeth" type="text" placeholder="" class="form-control">
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>اللثة</label>
                            <input disabled  value="{{ $entry->health_assessment_gum }}" name="health_assessment_gum" type="text" placeholder="" class="form-control">
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>تساقط الشعر</label>
                            <input disabled  value="{{ $entry->health_assessment_hairfall }}" name="health_assessment_hairfall" type="text" placeholder="" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>القرحة المعدية</label>
                            <input disabled  value="{{ $entry->gastric_ulcer }}" name="gastric_ulcer" type="text" placeholder="" class="form-control">
                        </div>
                        <div class="col-sm-2 form-group">
                            <label>الحموضة</label>
                            <input disabled  value="{{ $entry->Acidity }}" name="Acidity" type="text" placeholder="" class="form-control">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>تشنجات الكولون</label>
                            <input disabled  value="{{ $entry->colon_spasms }}" name="colon_spasms" type="text" placeholder="" class="form-control">
                        </div>
                        <div class="col-sm-2 form-group">
                            <label>اسهال</label>
                            <input disabled  value="{{ $entry->diarrhea }}" name="diarrhea" type="text" placeholder="" class="form-control">
                        </div>
                        <div class="col-sm-2 form-group">
                            <label>امساك</label>
                            <input disabled  value="{{ $entry->constipation }}" name="constipation" type="text" placeholder="" class="form-control">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-2 form-group">
                            <label>اقياء</label>
                            <input disabled  value="{{ $entry->vomiting }}" name="vomiting" type="text" placeholder="" class="form-control">
                        </div>
                        <div class="col-sm-2 form-group">
                            <label>غثيان</label>
                            <input disabled  value="{{ $entry->nausea }}" name="nausea" type="text" placeholder="" class="form-control">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>الشهية</label>
                            <input disabled  value="{{ $entry->appetite }}" name="appetite" type="text" placeholder="" class="form-control">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>النوم</label>
                            <input disabled  value="{{ $entry->sleep }}" name="sleep" type="text" placeholder="" class="form-control">
                        </div>
                        <div class="col-sm-2 form-group">
                            <label>التدخين</label>
                            <input disabled  value="{{ $entry->smoking }}" name="smoking" type="text" placeholder="" class="form-control">
                        </div>
                        </div>

                        <h3>قياسات المريض</h3>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label>الطول (سم)</label>
                                <input disabled  value="{{ $entry->patient_height }}" name="patient_height" onkeyup="calcBMI()" type="text" placeholder="" class="form-control">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>الوزن الحالي (كغ)</label>
                                <input disabled  value="{{ $entry->last_review->current_weight }}" name="current_weight" onkeyup="calcBMI()" type="text" placeholder="" class="form-control">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>الوزن المثالي</label>
                                <input disabled  value="{{ $entry->last_review->perfect_weight }}" name="perfect_weight" type="text" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label>السعرات الحرارية اليومية</label>
                                <input disabled  value="{{ $entry->daily_calories }}" name="daily_calories" type="text" placeholder="" class="form-control">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>نسبة الدهون</label>
                                <input disabled  value="{{ $entry->last_review->fat_percentage }}" name="fat_percentage" type="text" placeholder="" class="form-control">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label> نسبة السوائل</label>
                                <input disabled  value="{{ $entry->last_review->the_amount_of_fluid_needed }}" name="the_amount_of_fluid_needed" type="text" placeholder="" class="form-control">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label> نسبة العضلات</label>
                                <input disabled  value="{{ $entry->last_review->muscle_ratio }}" name="muscle_ratio" type="text" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label>النشاط الفيزيائي</label>
                                <input disabled  value="{{ $entry->last_review->physical_activity }}" name="physical_activity" type="text" placeholder="" class="form-control">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label> كتلة العظام </label>
                                <input disabled  value="{{ $entry->last_review->bone_mass }}" name="bone_mass" type="text" placeholder="" class="form-control">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label> عمر الحرق </label>
                                <input disabled  value="{{ $entry->last_review->age_of_the_burn }}" name="age_of_the_burn" type="text" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label>BMI </label>
                                <input disabled  value="{{ $entry->BMI }}" name="BMI" type="text" placeholder="" class="form-control">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label> درجة البدانة </label>
                                <input disabled  value="{{ $entry->last_review->the_degree_of_obesity }}" name="the_degree_of_obesity" type="text" placeholder="" class="form-control">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label> محيط العضد و المعصم </label>
                                <input disabled  value="{{ $entry->last_review->circumference_of_the_upper_arm_and_wrist }}" name="circumference_of_the_upper_arm_and_wrist" type="text" placeholder="" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3 form-group">
                                <label>محيط الخصر </label>
                                <input disabled  value="{{ $entry->last_review->waistline }}" name="waistline" type="text" placeholder="" class="form-control">
                            </div>
                            <div class="col-sm-3 form-group">
                                <label> الورك </label>
                                <input disabled  value="{{ $entry->last_review->hip }}" name="hip" type="text" placeholder="" class="form-control">
                            </div>
                            <div class="col-sm-3 form-group">
                                <label> الصدر</label>
                                <input disabled  value="{{ $entry->last_review->chest }}" name="chest" type="text" placeholder="" class="form-control">
                            </div>
                            <div class="col-sm-3 form-group">
                                <label> الفخذ</label>
                                <input disabled  value="{{ $entry->last_review->thigh }}" name="thigh" type="text" placeholder="" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
