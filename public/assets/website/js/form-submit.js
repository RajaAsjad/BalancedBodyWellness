  
    $(document).ready(function(){
        jQuery.validator.addMethod("lettersonly",function(e,t){return this.optional(t)||/^[a-zA-Z\s]+$/i.test(e)},"Invalid Value")
    });

    $(document).ready(function(){

        $(".form_submission").each(
            function(){
                $(this).validate({
                    rules:{
                        name:{required:!0,lettersonly:!0},
                        email:{email:!0,required:!0},
                        phone:{required:!0},
                        message:{required:!0}
                    },submitHandler:function(e){
                        var t={},
                        n=$(e).find("[data-name]");
                        if(0!=n.length){
                            for(var i=0;i<n.length;i++){
                                t[$(n[i]).attr("data-name")]=$(n[i]).val();
                            }
                        }
                        console.log(e);
                        $(e).find(".loader").show();
                        var a=$(e).find('[name="name"]').val(),
                        o=$(e).find('[name="email"]').val(),
                        l=$(e).find('[name="phone"]').val(),
                        r=$(e).find('[name="message"]').val(),
                        s=$(e).find('[name="url"]').val(),
                        c=$(e).find('[name="domain"]').val(),
                        u=$(e).find('[name="subject"]').val(),
                        so=$(e).find('[name="source"]').val(),
                        pt=$(e).find('[name="pkgtitle"]').val(),
                        pd=$(e).find('[name="title"]').val(),
                        tk  ='9'+Math.floor((Math.random() * 9999999999) + 1000000000);
                        
                        //   var gspprice = t.price;
                               
                        console.log(t);
                        $.ajax({
                            type:"POST",
                            url:"/include/send_data?action=form_submission",
                            dataType:"json",
                            data:{
                                name:a,
                                email:o,
                                phone:l,
                                message:r,
                                url:s,
                                domain:c,
                                subject:u,
                                source:so,
                                optional:t,
                                randomnum:tk
                            },success:function(t){
                                //  gspprices = gspprice.split(',').join('');
                             
                                // gsppricess = gspprices.substring(1);
                                // gsbprice= gsppricess.replace(/\/$/, '');
                              
                                console.log(t),
                                t.response?($(e).trigger("reset"),
                                $(e).find([type="submit"]).hide(),
                                $(e).find(".success").html("<p>Thank you for filling out your information!</p>"),
                                $(e).find(".success").show()):$(e).find(".error").html("Error Occurred"),
                                $(e).find(".loader").hide();
                                 window.location = "/thankyou";
                                //  if(gsbprice <= 4000){
                                //     window.location = "https://theamazonwriters.com/order/payment.php?tkn="+tk;
                                // }else{
                                //      window.location = "/thankyou";
                                // }
                               
                            },error:function(t,n,i){
                                console.log(t),
                                $(e).find(".error").html("Error Occurred "+i),
                                $(e).find(".loader").hide()
                            }
                        })
                    }
                })
        });
	})
