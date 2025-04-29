<!DOCTYPE html>
<html>
    <style>
        @media only screen and (max-width: 575px){
    #fdb{
      overflow-x: scroll;
    }
  }
  .blink_me {
  animation: blinker 1s linear infinite;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}
    </style>
<?php include 'head.php'; ?>

<body style="background-color: #a3a3a347;">
    <?php include 'head_menu.php'; ?>

    <div class="col-12 text-center mt-5">
        <h1>Checkins</h1>
    </div>
    <div class="m-5">
        <div class="fdb-block" style="max-width: 1000px !important; margin-left: auto !important; margin-right: auto !important;">
            <div id="fdb">
            <table id="tableee" class="table table-striped table-bordered">

<thead>
    <tr style="background-color: #8B8000 !important;">
            <th>Serial</th>
        <th>Room(s)</th>
        <th>Name</th>
        <th>Check-inn date</th>
        <th>Check-out date</th>
        <th>Total Bill</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    <?php $database->groupdata("checkins", "", "", "", ""); ?>
</tbody>

</table>
            </div>
            

        </div>
    </div>
    <?php include 'foot.php'; ?>
    <script type="text/javascript">
//new 6/4
        function search(ele) {
    if(event.key === 'Enter') {
        var id = ele.value;
        console.log("clicked");
        document.querySelector("#rm_rm").click();
    }
}
//


    $(document).ready(function() {

        var table =  $('#tableee').DataTable();

        var room = getCookie("room");
        $('#tableee').DataTable().search(room).draw();

//new 6/4
     $('#tableee_filter label input').on( 'focus', function () {
    this.setAttribute( 'onkeydown', 'search(this)' );
  });

     //



        $('div.dataTables_filter input', table.table().container()).focus();
$(function () {
    var focusedElement;
    $(document).on('focus', 'input', function () {
        if (focusedElement == this) return; //already focused, return so user can now place cursor at specific point in input.
        focusedElement = this;
        setTimeout(function () { focusedElement.select(); }, 100); //select all text in any field on focus for easy re-entry. Delay sightly to allow focus to "stick" before selecting.
    });
});
        eraseCookie("room");


    });


function eraseCookie(name) {   
    document.cookie = name+'=; Max-Age=-99999999;';  
}

    function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
    </script>
</body>

</html>