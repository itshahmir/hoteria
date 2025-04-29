<style>
  .footer {
    position: fixed;
    bottom: 0;
    right: 0;
  }
</style>
  <script type="text/javascript">       window.addEventListener("keyup", function(e){ if(e.keyCode == 192) history.back(); }, false);
</script>
<!-- 
<script type="text/javascript">
  $('body').on('keydown', 'input, select', function(e) {
    if (e.key === "Enter") {
        var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
        focusable = form.find('input,a,select,button,textarea').filter(':visible');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
        } else {
            form.submit();
        }
        return false;
    }
});
</script> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  $(document).ready( function () {
    $('#tableee').DataTable();
} );

  
</script>

      
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function(){
// make it as accordion for smaller screens
if (window.innerWidth > 992) {

  document.querySelectorAll('.navbar .nav-item').forEach(function(everyitem){

    everyitem.addEventListener('mouseover', function(e){

      let el_link = this.querySelector('a[data-bs-toggle]');

      if(el_link != null){
        let nextEl = el_link.nextElementSibling;
        el_link.classList.add('show');
        nextEl.classList.add('show');
      }

    });
    everyitem.addEventListener('mouseleave', function(e){
      let el_link = this.querySelector('a[data-bs-toggle]');

      if(el_link != null){
        let nextEl = el_link.nextElementSibling;
        el_link.classList.remove('show');
        nextEl.classList.remove('show');
      }


    })
  });

}
// end if innerWidth
}); 
// DOMContentLoaded  end
</script>
<script>
function filterText()
    {  
        var rex = new RegExp($('#filterText').val());
        if(rex =="/all/"){clearFilter()}else{
            $('.content').hide();
            $('.content').filter(function() {
            return rex.test($(this).text());
            }).show();
    }
    }
    
function clearFilter()
    {
        $('.filterText').val('');
        $('.content').show();
    }

    $( document ).ready(function() {
   $("input").on("change", function() {
    this.setAttribute(
        "data-date",
        moment(this.value, "DD-MM-YYYY")
        .format( this.getAttribute("data-date-format") )
    )
}).trigger("change")
});
</script>
<script type="text/javascript">
    $(document).on("mousedown", function (e1) {
  $(document).one("mouseup", function (e2) {
    if (e1.which == 2 && e1.target == e2.target) {
      var e3 = $.event.fix(e2);
      e3.type = "middleclick";
      $(e2.target).trigger(e3)
    }
  });
});

    $(document).on("middleclick", function (e) {
    window.location.href = "index.php";
});
</script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="bootstrap/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>