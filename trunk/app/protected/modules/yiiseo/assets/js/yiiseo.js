$(document).ready(function(){

    $( document ).on("click", ".meta-name", function(){
        var name = $("#name").val();
        var url = $("#seo-url-id").val();
        if(name == "")
            alert("Change Meta Name");
        else{
            $.ajax( {
                url: '/yiiseo/seo/addmetaname',
                type: 'POST',
                data: {name : name, url : url},
                success: function (msg) {
                    $("#load-meta-name").append(msg);
                }
            });
        }
    });

    $( document ).on("click", ".deleteblock", function(){
        var ptr = confirm('Are you sure you want to detele this tag ?');
        if(ptr){
            var id = $(this).data("id");
            console.log(id);
            var $this = $(this);
            if(id == null)
            {
                $(this).parent().fadeOut();
            }
            else{
                $.ajax( {
                    url: '/yiiseo/seo/deletemetaname',
                    type: 'POST',
                    data: {id : id},
                    success: function (msg) {
                        $this.parent().fadeOut(500,function(){
                            $this.parent().parent().remove();
                        });
                    }
                });
            }

        }
        return false;
    });


    $( document ).on("click",".meta-property", function(){
        var count = $(this).data("count");
        var url = $("#seo-url-id").val();
        var $this = $(this);
        console.log(count);
        $.ajax( {
            url: '/yiiseo/seo/addmetaproperty',
            type: 'POST',
            data: {count : count, url : url },
            success: function (msg) {
                $("#load-meta-property").append(msg);
                $this.data("count",++count);
            }
        });
    });


    $( document ).on("click", ".deleteproperty", function(){
        var ptr = confirm('Are you sure you want to detele this tag ?');
        if(ptr){
            var id = $(this).data("id");
            console.log(id);
            var $this = $(this);
            if(id == null)
            {
                $(this).parent().fadeOut();
            }
            else{
                $.ajax( {
                    url: '/yiiseo/seo/deletemetaproperty',
                    type: 'POST',
                    data: {id : id},
                    success: function (msg) {
                        $this.parent().fadeOut(500,function(){
                            $this.parent().remove();
                        });
                    }
                });
            }

        }
        return false;
    });
    
    $( document ).on('change', '.select-params', function(){
        var mythis = $(this);
        var param = ' {'+mythis.val()+'}';
        var field = mythis.parents('.panel-body').find('textarea');
        field.val(field.val()+param);
    });

    $( document ).on('change', '.select-params-keywords', function(){
        var mythis = $(this);
        var param = ' {'+mythis.val()+'}';
         $('#tags').tagsinput('add',param);
    });

    $( document ).on('change', '.select-params-property', function(){
        var mythis = $(this);
        var param = ' {'+mythis.val()+'}';
        var field = mythis.parents('.property').find('.property-content');
        field.val(field.val()+param);
    });

});
