<script src = "<?php echo $head_url;?>/assets/js/jquery-1.10.2.js"></script>
<script>
    $(function() {  
        $('#new_pan_card').on('focusout', function () {
    	    if($('#new_pan_card').val() != ''){
					    $("#pan_ver_clck").removeClass("hidden");
    	    }
        });
    
        $("#pin_code").on("focusout",function(){ 
            var pincode = $("#pin_code").val();
            $.ajax({
                data: "pincode="+pincode,
                type: "POST",
                url: "<?php echo $head_url;?>/include/get-city.php",
                success:function(data){
                    if(data != ''){
                        var element = data.split("@#");
                        $("#city_id").val(element[0]);
                        $("#state").val(element[1]);
                    }
                }
            });
        });

        $("#ofc_pincode").on("focusout",function(){
            var ofc_pincode = $("#ofc_pincode").val();
            $.ajax({
                data: "pincode="+ofc_pincode,
                type: "POST",
                url: "<?php echo $head_url;?>/include/get-city.php",
                success:function(data) {
                    if(data != '') {
                        var element = data.split("@#");
                        $("#work_city").val(element[0]);
                    }
                }
            });    
        });
    });

    function suggestion_box(get_val,offers_level_type=0){
        var query_id = $("input[name='query_id']").val();
        var cust_iddd = $("#cust_iddd").val();
        var url = "<?php echo $head_url; ?>/offers/index.php";

        $.ajax({
            method:'GET',
            cache:'false',  
            url: url,
            data: "query_id="+query_id+"&cust_iddd="+cust_iddd,
            success: function(response) {
                $("#new_offers_journey").html(response);
                verticalToggle('step1');
            }
        });
        //Changes - GoldLoanApi - Akash - Ends
    }

    function cibil_summary(cibil,destId){
        $.ajax({      
	        method:'POST',
	        cache:'false',  
	        beforeSend: function () {
                $("#experian_buttn").attr('value', 'Processing...').prop('disabled', true);
            },
            url: "<?php echo $head_url; ?>/sugar/report/credit-report-summary.php",
	        data: "destId="+btoa(destId)+"&cibil="+btoa(cibil),
		    success: function(response) {                                           
			    $(".id01").html("").html(response);
			    lead_popup();
			    $("#experian_buttn").attr('value', 'Experian').prop('disabled', false);
		    }                                                                                 
    	});
    }


    function cibil_epf_summary(epf_id,destId){
        $.ajax({      
            method:'POST',
            cache:'false',  
            beforeSend: function () {
                $("#epf_buttn").attr('value', 'Processing...').prop('disabled', true);
            },
            url: "<?php echo $head_url; ?>/sugar/insert/epf-summary.php",
            data: "destId="+btoa(destId)+"&epf_id="+btoa(epf_id),
            success: function(response) {                                           
                $(".id01").html("").html(response);
                lead_popup();
                $("#epf_buttn").attr('value', 'EPF').prop('disabled', false);
            }                                                                                 
        });
    }
    
    function validatePAN(pan){ 
        var regex = /[A-Za-z]{5}[0-9]{4}[A-Za-z]{1}$/; 
        return regex.test(pan); 
    }    
    function validatePAN(pan){ 
        var regex = /[A-Za-z]{5}[0-9]{4}[A-Za-z]{1}$/; 
        return regex.test(pan); 
    }

    function p1(){
        $('#see').hide();
    }
    function p2(){
        $('#see').show();
    }
    function number_show(id,src){
        var id = id;
        var src = src;
        $.ajax({
            data: "id="+id+'&src='+src,
            type: "POST",
            beforeSend: function () {
                $("#show_btn").attr('onclick', '');
            },
            url: "/query/show_number_history.php",
            success:function(data){
                $("#phone_no").val(data);
                $('html, body').animate({
                    scrollTop: $("#phone_no").offset().top - 160
                }, 1000);
            }
        });
    }

    function report_pos(pos_val){
	    if(pos_val == 'Credit Summary'){
		    $('.main_div').animate({
                scrollTop: $("#summary_table").offset().top-180
            }, 1000);
		  	
	    } else if(pos_val == 'Credit Enquiry'){
		    $('.main_div').animate({
                scrollTop: $("#enquiry_table").offset().top-105
            }, 1000);	
	    }
    }

    function like_dislike_save(pat_id, contact_id, level_type, mgr_type, like_dislike_flag, loan_type, level_id, city_id) {
        if(pat_id && contact_id && level_type && mgr_type && like_dislike_flag && city_id) {
            if(like_dislike_flag == 1) {            
                $("#"+contact_id+"_"+mgr_type+"_"+like_dislike_flag+"_"+city_id).addClass("like-shadow-effect");
                $("#"+contact_id+"_"+mgr_type+"_"+like_dislike_flag+"_"+city_id).removeClass("dislike-shadow-effect");            
            } else {            
                $("#"+contact_id+"_"+mgr_type+"_"+like_dislike_flag+"_"+city_id).addClass("dislike-shadow-effect");
                $("#"+contact_id+"_"+mgr_type+"_"+like_dislike_flag+"_"+city_id).removeClass("like-shadow-effect");            
            }
            this_val = $(this);
            console.log(this_val);
            $.ajax({
                type: "POST",
                url: "../insert/valid_rm_sm_insert.php",
                data: "pat_id="+pat_id+"&contact_id="+contact_id+"&level_type="+level_type+"&mgr_type="+mgr_type+"&like_dislike_flag="+like_dislike_flag+"&loan_type="+loan_type+"&level_id="+level_id+"&city_id="+city_id,
                success: function(response) {
                    res = JSON.parse(response);
                    if(res.status == 0) {
                        alert("Action not performed. Data missing.");
                    } else {
                        alert("Successfully saved");
                    }
                }
            });        
        } else {
            alert("Action not performed. Data missing");
        }
    }

    function show_hide_con(class_name) {
        var maxLength = 100;
        $(class_name).each(function() {
            var myStr = $(this).text();
            if($.trim(myStr).length > maxLength) {
                var newStr = myStr.substring(0, maxLength);
                var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                $(this).empty().html(newStr);
                $(this).append(' <a href="javascript:void(0);" class="read-more"> Read more... </a>');
                $(this).append('<span class="more-text hidden">' + removedStr + '<a href="javascript:void(0);" class="read-less"> Read less... </a> </span>');
            }
        });

        $(".read-more").click(function() {
            $(this).siblings(".more-text").removeClass("hidden");
            $(this).addClass("hidden");
        });

        $(".read-less").click(function() {
            $(this).parent().addClass("hidden");
            $(this).parent().prev().removeClass("hidden");
        });
    }

    function alt_number_show(id, src) {
        var id = id;
        var src = src;
        $.ajax({
            data: "id="+id+'&src='+src,
            type: "POST",
            beforeSend: function () {
                $("#show_alt_btn").attr('onclick', '');
            },
            url: "../insert/show_alternate_number.php",
            success:function(data) {
                $("#alt_phone_no").val(data);
            }
        });
    }
</script>