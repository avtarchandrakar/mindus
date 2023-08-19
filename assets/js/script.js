function MoveTextBox(ids) {
    $(ids).find("input,select").each(function () {
        var num_type = $(this).attr("text-type");
//        TextFormat(num_type, $(this).attr('id'));
        $(this).on("keydown", function (event) {
            var tabindex = $(this).attr('tabindex');
            if (event.which == 13) {
                tabindex++;
                $('[tabindex=' + tabindex + ']').focus();
                event.preventDefault();
                return false;
            }
            var autocomplete = $(this).attr("list");
            if (!($(this).is("select")) && (autocomplete == "" || autocomplete == null || autocomplete == undefined)) {
                if (event.which == 38) {
                    tabindex--;
                }
                else if (event.which == 40) {
                    tabindex++;
                }
                $('[tabindex=' + tabindex + ']').focus();
            }
        });
    }
	);
    $("[tabindex='1']").focus();
}

function MoveTextBoxRefresh(ids) {
    $(ids).find("input,select").each(function () {
        var num_type = $(this).attr("text-type");
//        TextFormat(num_type, $(this).attr('id'));
        $(this).on("keydown", function (event) {
            var tabindex = $(this).attr('tabindex');
            if (event.which == 13) {
                tabindex++;
                $('[tabindex=' + tabindex + ']').focus();
                event.preventDefault();
                return false;
            }
            var autocomplete = $(this).attr("list");
            if (!($(this).is("select")) && (autocomplete == "" || autocomplete == null || autocomplete == undefined)) {
                if (event.which == 38) {
                    tabindex--;
                }
                else if (event.which == 40) {
                    tabindex++;
                }
                $('[tabindex=' + tabindex + ']').focus();
            }
        });
    }
    );
}

function getCurDate(){
  var currentdate = new Date(); 
      var datetime = ("0" + currentdate.getDate()).slice(-2) + "-"
      + ("0" + (currentdate.getMonth() + 1)).slice(-2)  + "-" 
      + currentdate.getFullYear();
      return datetime;
}
function  getPOSFromCompany(id)
{
    var url=$('#baseurl').val()+"index.php/helperController/getPOSFromCompany";
    $.ajax({
        type : 'POST',
        dataType : 'json',
        async : false,
        url : url,
        data : {
            subid : id
        },
        success : function(data) {
            var options="<option value='null'>Select POS</option>";
            for(var i=0;i<data.length;i++)
                {
                options=options+"<option value='"+data[i].id+"'>"+data[i].name+"</option>";
                }
            $('#pos_id').find('option').remove().end().append(options);
        },
        complete : function() {
        }
    });
}

function CheckPermission(form_id){
    //$('.btn_entry,.btn_modify,.btn_del').addClass('hidden');
    //$('.btn_entry,.btn_modify,.btn_del').css('display','none');
    var url=$('#baseurl').val()+"index.php/userController/permission_get?form_id="+form_id;
    $.ajax({
        url: url,
        type: "GET",
        cache: false,
        success: function (html) {
            $('#permission').val(html);
            var piece = $('#permission').val().split(",");
            entry=piece[0];
            modify=piece[1];
            del=piece[2];
            if(entry==1){
                $('.btn_entry').css('display','inline');
            }
            if(modify==1){
                $('.btn_modify').css('display','inline');
            }
            if(del==1){
                $('.btn_del').css('display','inline');
            }
        }
    });
}
