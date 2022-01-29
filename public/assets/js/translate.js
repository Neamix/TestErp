let translateJsonEn = {
    'saturday': 'saturday',
    'sunday':'sunday',
    'monday': 'monday',
    'tuesday':'tuesday',
    'wednesday': 'wednesday',
    'thursday': 'thursday',
    'friday': 'friday',
    'no_data_available_in_table' : 'No data available in table'
}

let translateJsonAr = {
    'saturday': 'السبت',
    'sunday':'الاحد',
    'monday': 'الاثنين',
    'tuesday':'الثلاثاء',
    'wednesday': 'الاربعاء',
    'thursday': 'الخميس',
    'friday': 'الجمعه',
    'no_data_available_in_table': 'لا يوجد بيانات في الجدول'
}

console.log(window.lang)
function getTranslateValue($value) {
    let translate;
    if(window.lang == 'en') {
        translate = translateJsonEn[$value];
    } else {
        translate = translateJsonAr[$value];
    }

    return translate;
}