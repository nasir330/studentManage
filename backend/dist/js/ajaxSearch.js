
//Venture search input
$('#searchVenture').on('keyup', function () {   
   var name = $(this).val();
 
   //post form data          
   $.ajax({
      url: "/venture-search",
      type: "GET",
      data: { 'name': name },
      success: function (data) {
         //console.log(data);
         $('#ventureTable').html(data);
      }
   });
});
//VenturePlots search input
$('#searchVenturePlots').on('keyup', function () {     
   var name = $(this).val();
  
   //post form data          
   $.ajax({
      url: "/venture-plots-search",
      type: "GET",
      data: { 'name': name },
      success: function (data) {
         //console.log(data);
         $('#venturePlotsTable').html(data);
      }
   });
});
