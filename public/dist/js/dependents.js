
 $( document ).ready(function() {

    load_specialties();

    $('#service_id').on('change', function () {
        load_speci_by_service(this.value);
    });
});

function load_speci_by_service(serv_id) {
   var list_speci = load_specialties();
   $('#specialty_id').empty();
   console.log(serv_id);
   for(var i=0; i  < list_speci.length; i++){
       if(list_speci[i].service_id == serv_id){
           $("#specialty_id").append(new Option(list_speci[i].name, list_speci[i].id));
       }
   }
}

function load_specialties() {
   const speci_list = JSON.parse($('#specialties_list').val());
   console.log(speci_list);
   return speci_list;
}

