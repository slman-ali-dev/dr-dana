@extends(backpack_view('blank'))

@php

@endphp

@section('content')

<div class="container" style="direction: rtl !important;">
        </br>
        <h1 class="well">استمارة المريض</h1>
        </br>

        <div class="col-lg-12 well">
            <div class="row">
                <form  action="{{ route('patientFormStore') }}" method="POST" >
                    @csrf
                    <h3>معلومات عامة</h3>
                    <hr>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label>اسم المريض</label>
                                <input required type="text" name="patient_name" placeholder="ادخل الاسم هنا..." class="form-control">
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>الجنس</label>
                                <select required class="form-control" id="gender" name="gender"
                                    onchange="showDiv('hidden_div', this)">
                                    <option>غير محدد</option>
                                    <option value="male">ذكر</option>
                                    <option value="female">أنثى</option>

                                </select>
                            </div>
                            <div class="col-sm-2 form-group">
                                <label>العمر</label>
                                <input onkeyup="calcBMI()" name="age" type="number" placeholder="" class="form-control">
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>العمل</label>
                                <input name="job" type="text" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>رقم الهاتف</label>
                                <input name="phone" type="phone" placeholder="ادخل الرقم هنا..." class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>العنوان</label>
                                <input name="address" type="text" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-6 form-group">
                                <label>المؤهل العلمي</label>
                                <select name="qualification" class="form-control">
                                    <option value="غير محدد">غير محدد</option>
                                    <option value="غير متعلم">غير متعلم</option>
                                    <option value="تاسع">تاسع</option>
                                    <option value="بكالوريا">بكالوريا</option>
                                    <option value="جامعة">جامعة</option>
                                    <option value="ماستر">ماستر</option>
                                    <option value="دكتوراه">دكتوراه</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>الوضع العائلي</label>
                                <select class="form-control" id="marry" name="family_status"
                                    onchange="showDiv1('hidden_div1', this)">
                                    <option>غير محدد</option>
                                    <option value="single">عازب</option>
                                    <option value="married">متزوج</option>

                                </select>
                            </div>

                        </div>
                        <div id="hidden_div1" style="display: none">
                            <div class="row">

                                <div class="col-sm-6 form-group">
                                    <label> عدد الاولاد</label>
                                    <input name="childs_no" type="text" placeholder="" class="form-control">

                                </div>

                            </div>
                        </div>
                        <div id="hidden_div" style="display: none">
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>الحمل</label>
                                    <select name="pregnant" class="form-control">
                                        <option value="يوجد حمل">يوجد حمل</option>
                                        <option value="غير حامل">غير حامل</option>

                                    </select>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>الارضاع</label>
                                    <select name="breastfeeding" class="form-control">
                                        <option value="غير محدد">غير محدد</option>
                                        <option value="مرضعة">مرضعة</option>
                                        <option value="غير مرضعة">غير مرضعة</option>

                                    </select>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>الدورة الشهرية</label>
                                    <select name="period" class="form-control">
                                        <option value="غير محدد">غير محدد</option>
                                        <option value="منتظمة">منتظمة</option>
                                        <option value="غير منتظمة">غير منتظمة</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>أمراض السكري</label>
                                <select name="diabetes" class="form-control">
                                    <option value="لا يوجد"
                                     >لا يوجد </option>
                                    <option value="يوجد"
                                    >يوجد</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>BCO</label>
                                <select name="bco" class="form-control">
                                    <option value="لا يوجد"
                                     >لا يوجد </option>
                                    <option value="يوجد"
                                    >يوجد</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label>امراض الغدد</label>
                                <textarea name="endocrine_diseases" type="text" rows="3" placeholder="أدخل وصفا للحالة"
                                    class="form-control"></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>وجود أمراض أخرى</label>
                                <textarea name="other_diseases" type="text" rows="3" placeholder="أدخل وصفا للحالة"
                                    class="form-control"></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>اجراء عمليات جراحية سابقة</label>
                                <textarea name="past_surgery" type="text" rows="3" placeholder="أدخل وصفا للحالة"
                                    class="form-control"></textarea>
                            </div>

                        </div>
                        <h3>التقييم الصحي</h3>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label>الأسنان</label>
                                <input name="health_assessment_teeth" type="text" placeholder="" class="form-control">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>اللثة</label>
                                <input name="health_assessment_gum" type="text" placeholder="" class="form-control">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>تساقط الشعر</label>
                                <input name="health_assessment_hairfall" type="text" placeholder="" class="form-control">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-3 form-group">
                                <label>القرحة المعدية</label>
                                <select name="gastric_ulcer" class="form-control">
                                    <option value="لا يوجد">لا يوجد</option>
                                    <option value="يوجد">يوجد</option>
                                </select>
                            </div>
                            <div class="col-sm-2 form-group">
                                <label>الحموضة</label>
                                <select name="Acidity" class="form-control">
                                    <option value="لا يوجد">لا يوجد</option>
                                    <option value="يوجد">يوجد</option>
                                </select>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>تشنجات الكولون</label>
                                <select name="colon_spasms" class="form-control">
                                    <option value="لا يوجد">لا يوجد</option>
                                    <option value="يوجد">يوجد</option>
                                </select>
                            </div>
                            <div class="col-sm-2 form-group">
                                <label>اسهال</label>
                                <select name="diarrhea" class="form-control">
                                    <option value="لا يوجد">لا يوجد</option>
                                    <option value="يوجد">يوجد</option>
                                </select>
                            </div>
                            <div class="col-sm-2 form-group">
                                <label>امساك</label>
                                <select name="constipation" class="form-control">
                                    <option value="لا يوجد">لا يوجد</option>
                                    <option value="يوجد">يوجد</option>
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-2 form-group">
                                <label>اقياء</label>
                                <select name="vomiting" class="form-control">
                                    <option value="لا يوجد" >لا يوجد</option>
                                    <option value="يوجد" >يوجد</option>
                                </select>
                            </div>
                            <div class="col-sm-2 form-group">
                                <label>غثيان</label>
                                <select name="nausea" class="form-control">
                                    <option value="لا يوجد" >لا يوجد</option>
                                    <option value="يوجد" >يوجد</option>
                                </select>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>الشهية</label>
                                <select name="appetite" class="form-control">
                                    <option value="لا يوجد">لا يوجد</option>
                                    <option value="يوجد">يوجد</option>
                                </select>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>النوم</label>
                                <select name="sleep" class="form-control">
                                    <option value="أقل من 6 ساعات" >أقل من 6 ساعات</option>
                                    <option value=" 6 ساعات" > 6 ساعات</option>
                                    <option value="أكثر من 6 ساعات" >أكثر من 6 ساعات</option>

                                </select>
                            </div>
                            <div class="col-sm-2 form-group">
                                <label>التدخين</label>
                                <select name="smoking" class="form-control">
                                    <option value="لا يوجد" >لا يوجد</option>
                                    <option value="اركيلة" >اركيلة</option>
                                    <option value="دخان" >دخان</option>

                                </select>
                            </div>
                            </div>

                            <h3>قياسات المريض</h3>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>الطول (سم)</label>
                                    <input name="patient_height" onkeyup="calcBMI()" type="text" placeholder="" class="form-control">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>الوزن الحالي (كغ)</label>
                                    <input name="current_weight" onkeyup="calcBMI()" type="text" placeholder="" class="form-control">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>الوزن المثالي</label>
                                    <input name="perfect_weight" type="text" placeholder="" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>السعرات الحرارية اليومية</label>
                                    <input name="daily_calories" type="text" placeholder="" class="form-control">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>نسبة الدهون</label>
                                    <input name="fat_percentage" type="text" placeholder="" class="form-control">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label> نسبة السوائل</label>
                                    <input name="current_amount_of_fluid" type="text" placeholder="" class="form-control">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label> نسبة العضلات</label>
                                    <input name="muscle_ratio" type="text" placeholder="" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-sm-3 form-group">
                                <label>الكمية اللازمة من السوائل</label>
                                <input name="the_amount_of_fluid_needed" type="text" placeholder="" class="form-control">
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>النشاط الفيزيائي</label>
                                <select name="physical_activity" class="form-control">
                                    <option value="1.2">1.2</option>
                                    <option value="1.5">1.5</option>
                                    <option value="1.7">1.7</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>معدل الاستقلاب الأساسي</label>
                                <input name="basal_metabolic_rate" onkeyup="calcBMI()" type="number" placeholder="" class="form-control">
                            </div>
                            <div class="col-sm-3 form-group">
                                <label>معدل الاستقلاب العام</label>
                                <input name="general_metabolic_rate" type="text" placeholder="" class="form-control">
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label> كتلة العظام </label>
                                    <input name="bone_mass" type="text" placeholder="" class="form-control">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label> عمر الحرق </label>
                                    <input name="age_of_the_burn" type="text" placeholder="" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>BMI </label>
                                    <input name="BMI" type="text" placeholder="" class="form-control">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label> درجة البدانة </label>
                                    <input name="the_degree_of_obesity" type="text" placeholder="" class="form-control">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label> محيط العضد و المعصم </label>
                                    <input name="circumference_of_the_upper_arm_and_wrist" type="text" placeholder="" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3 form-group">
                                    <label>محيط الخصر </label>
                                    <input name="waistline" type="text" placeholder="" class="form-control">
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label> الورك </label>
                                    <input name="hip" type="text" placeholder="" class="form-control">
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label> الصدر</label>
                                    <input name="chest" type="text" placeholder="" class="form-control">
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label> الفخذ</label>
                                    <input name="thigh" type="text" placeholder="" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-lg btn-info">اضافة استمارة المريض</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('after_scripts')
    <script>
        function showDiv(divId, element) {
            document.getElementById(divId).style.display = element.value == "female" ? 'block' : 'none';
        }
        function showDiv1(divId, element) {
            document.getElementById(divId).style.display = element.value == "married" ? 'block' : 'none';
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

@endpush

@push('before_scripts')
    
    <script>
        function  calcBMI(){
            let patient_height = document.getElementsByName("patient_height")[0].value;
            let height_m = patient_height / 100;
            let current_weight = document.getElementsByName("current_weight")[0].value;
            let patient_age = document.getElementsByName("age")[0].value;
            let basal_metabolic_rate = document.getElementsByName("basal_metabolic_rate")[0].value;

            let physical_activity = document.getElementsByName("physical_activity")[0];
            physical_activity = physical_activity.options[physical_activity.selectedIndex].value;

            let gender = document.getElementsByName("gender")[0];
            gender = gender.options[gender.selectedIndex].value;

            if(height_m > 0){
                let bmi = parseFloat(current_weight / (height_m * height_m)).toFixed(4);
                document.getElementsByName("BMI")[0].value = bmi;
                let degree_of_obesity = "";
                
                if(bmi > 0 && bmi < 20){
                    degree_of_obesity = "نقص وزن";
                }else if(bmi >= 20 && bmi < 25){
                    degree_of_obesity = "وزن ضعيف";
                }else if(bmi >= 25 && bmi < 30){ 
                    degree_of_obesity = "زيادة وزن";
                }else if(bmi >= 30 && bmi < 35){
                    degree_of_obesity = "بدانة درجة أولى";
                }else if(bmi >= 35 && bmi < 40){
                    degree_of_obesity = "بدانة درجة ثانية";
                }else if(bmi >= 40 && bmi < 45){
                    degree_of_obesity = "بدانة درجة ثالثة";
                }else if(bmi >= 45){
                    degree_of_obesity = "بدانة مفرطة مرضية";
                }
                document.getElementsByName("the_degree_of_obesity")[0].value = degree_of_obesity;
            }
            if(current_weight > 0){
                document.getElementsByName("the_amount_of_fluid_needed")[0].value = 175 + (current_weight * 15);
            }
            if(gender == "male"){
                document.getElementsByName("daily_calories")[0].value = 655.10 + (6.56 * current_weight) + (1.85 * patient_height) - (4.68 * patient_age);
            }else if(gender == "female"){
                document.getElementsByName("daily_calories")[0].value = 66.7 + (13.75 * current_weight) + (5 * patient_height) - (6.76 * patient_age);
            }

            if(basal_metabolic_rate > 0){
                document.getElementsByName("general_metabolic_rate")[0].value = basal_metabolic_rate * physical_activity;
            }

            if(patient_height > 0){
                document.getElementsByName("perfect_weight")[0].value = 100 - (patient_height - 150) / 4;
            }

        }
    </script>

@endpush