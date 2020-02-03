/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * JS for Profile
*/ 


$(document).ready(function() 
{
    
    $.post("../ajax_call.php",{request:'getCountriesForSelectbox'},function(data) 
    {
        $("#cCountry").html(trim(data));
        $("#cRegCountry").html(trim(data));
        $("#cPickup_country").html(trim(data));

        $('#cCountry option[value="'+trim($("#cCountry_id").val())+'"]').prop('selected', true);
        $('#disp_cCountry').html($('#cCountry option[value="'+trim($("#cCountry_id").val())+'"]').html());

        $('#cRegCountry option[value="'+trim($("#cRegCountry_id").val())+'"]').prop('selected', true);
        $('#disp_cRegCountry').html($('#cRegCountry option[value="'+trim($("#cRegCountry_id").val())+'"]').html());

        $('#cPickup_country option[value="'+trim($("#cPickup_country_id").val())+'"]').prop('selected', true);
        $('#disp_cPickup_country').html($('#cPickup_country option[value="'+trim($("#cPickup_country_id").val())+'"]').html());

        $('#cFirm option[value="'+trim($("#cFirm_val").val())+'"]').prop('selected', true); 
        if($("#cFirm_val").val() == 'Proprietor')
        {
            $("#sole_Doc").show();
            $("#partnership_Doc").hide();
            $("#ltd_Doc").hide();

            $("#disp_sole_Doc").show();
            $("#disp_partnership_Doc").hide();
            $("#disp_ltd_Doc").hide();
        }
        else if($("#cFirm").val() == 'Partnership')
        {
            $("#sole_Doc").hide();
            $("#partnership_Doc").show();
            $("#ltd_Doc").hide();

            $("#disp_sole_Doc").hide();
            $("#disp_partnership_Doc").show();
            $("#disp_ltd_Doc").hide();
        }
        else if($("#cFirm").val() == 'Limited' || $("#cFirm").val() == 'Private Limited')
        {
            $("#sole_Doc").hide();
            $("#partnership_Doc").hide();
            $("#ltd_Doc").show();

            $("#disp_sole_Doc").hide();
            $("#disp_partnership_Doc").hide();
            $("#disp_ltd_Doc").show();
        }

        getStatesForSelectbox();
        getRegStatesForSelectbox();
        getPickupStatesForSelectbox();

        $.post("../ajax_call.php",{request:'getBanksForSelectbox'},function(data) 
        {
            $("#cAcc_bankname").html(trim(data));
            $('#cAcc_bankname option[value="'+trim($("#cAcc_bank_id").val())+'"]').prop('selected', true);
            $('#disp_cAcc_bankname').html($('#cAcc_bankname option[value="'+trim($("#cAcc_bank_id").val())+'"]').html());
        });
        
    });

    $("#cCountry").change(function()
    {
        getStatesForSelectbox();
    });

    $("#cRegCountry").change(function()
    {
        getRegStatesForSelectbox();
    });

    $("#cPickup_country").change(function()
    {
        getPickupStatesForSelectbox();
    });

    $("#cSellerlist").change(function()
    {
        window.location.href="index.php?iSeller_id="+$('#cSellerlist').val();
    });

    $('#cSellerlist option[value="'+trim($("#iSeller_id").val())+'"]').prop('selected', true);
    $('#cPassword').val('');
    $('#cVPassword').val('');
    
    $(".boxer").boxer();

//    iSeller_id = $('#iSeller_id').val()
//    $.post("ajax_call.php",{request:'getOrderStatus',iSeller_id:iSeller_id},function(data) 
//    {
//        $("#table_status_list").html(trim(data));
//        $("#loading_status_list").hide();
//
//    });
});    
       
        
function getStatesForSelectbox()
{
    cCountry = trim($("#cCountry").val());
    if(cCountry != '')
    {
        $.post("../ajax_call.php",{request:'getStatesForSelectbox',cCountry:cCountry},function(data) 
        {
            $("#cState").html(trim(data));
            $('#cState option[value="'+trim($("#cState_id").val())+'"]').prop('selected', true);
            $('#disp_cState').html($('#cState option[value="'+trim($("#cState_id").val())+'"]').html());
        });
    }
}

function getRegStatesForSelectbox()
{
    cCountry = trim($("#cRegCountry").val());
    if(cCountry != '')
    {
        $.post("../ajax_call.php",{request:'getStatesForSelectbox',cCountry:cCountry},function(data) 
        {
            $("#cRegState").html(trim(data));
            $('#cRegState option[value="'+trim($("#cRegState_id").val())+'"]').prop('selected', true);
            $('#disp_cRegState').html($('#cRegState option[value="'+trim($("#cRegState_id").val())+'"]').html());
        });
    }
}

function getPickupStatesForSelectbox()
{
    cCountry = trim($("#cPickup_country").val());
    if(cCountry != '')
    {
        $.post("../ajax_call.php",{request:'getStatesForSelectbox',cCountry:cCountry},function(data) 
        {
            $("#cPickup_state").html(trim(data));
            $('#cPickup_state option[value="'+trim($("#cPickup_state_id").val())+'"]').prop('selected', true);
            $('#disp_cPickup_state').html($('#cPickup_state option[value="'+trim($("#cPickup_state_id").val())+'"]').html());
        });
    }
}

function edit_seller(tab)
{
    $("#display_"+tab).hide();
    $("#edit_"+tab).show();
}

function cancel(tab)
{
    $("#display_"+tab).show();
    $("#edit_"+tab).hide();
}

function update_seller(tab)
{
    seller_data = '';
    iSeller_id  = $("#iSeller_id").val();
    if(tab == 'business_information')
    {
        cEstName        = trim($('#cEstName').val());
        cRegName        = trim($('#cRegName').val());
        cWebsite        = trim($('#cWebsite').val());
        cContactPerson  = trim($('#cContactPerson').val());
        cDesignation    = trim($('#cDesignation').val());
        cVAT            = trim($('#cVAT').val());
        cCST            = trim($('#cCST').val());
        cPAN            = trim($('#cPAN').val());
        cCIN            = trim($('#cCIN').val());
        cAddress        = trim($('#cAddress').val());
        cPincode        = trim($('#cPincode').val());
        cCountry        = trim($('#cCountry').val());
        cState          = trim($('#cState').val());
        cCity           = trim($('#cCity').val());
        cBusinessSpan   = trim($('#cBusinessSpan').val());
        cBusinessArea   = trim($('#cBusinessArea').val());
        cRegAddress     = trim($('#cRegAddress').val());
        cRegPincode     = trim($('#cRegPincode').val());
        cRegCountry     = trim($('#cRegCountry').val());
        cRegState       = trim($('#cRegState').val());
        cRegCity        = trim($('#cRegCity').val());
        cTelephone      = trim($('#cTelephone').val());
        cMobile         = trim($('#cTelephone').val());
        cFacsimile      = trim($('#cFacsimile').val());
        cEmail          = trim($('#cEmail').val());
        cPassword       = trim($('#cPassword').val());
        cVPassword      = trim($('#cVPassword').val());

        $.post("update_seller_profile.php",{tab:tab,iSeller_id:iSeller_id,cEstName:cEstName,cRegName:cRegName,cWebsite:cWebsite,cContactPerson:cContactPerson,cDesignation:cDesignation,cVAT:cVAT,cCST:cCST,cPAN:cPAN,cCIN:cCIN,cAddress:cAddress,cPincode:cPincode,cCountry:cCountry,cState:cState,cCity:cCity,cBusinessSpan:cBusinessSpan,cBusinessArea:cBusinessArea,cRegAddress:cRegAddress,cRegPincode:cRegPincode,cRegCountry:cRegCountry,cRegState:cRegState,cRegCity:cRegCity,cTelephone:cTelephone,cMobile:cTelephone,cFacsimile:cFacsimile,cEmail:cEmail,cPassword:cPassword,cVPassword:cVPassword},function(data) 
        {

            if(trim(data) == "updated")
            {
                $('#disp_cEstName').html($('#cEstName').val());
                $('#disp_cRegName').html($('#cRegName').val());
                $('#disp_cWebsite').html($('#cWebsite').val());
                $('#disp_cContactPerson').html($('#cContactPerson').val());
                $('#disp_cDesignation').html($('#cDesignation').val());
                $('#disp_cVAT').html($('#cVAT').val());
                $('#disp_cCST').html($('#cCST').val());
                $('#disp_cPAN').html($('#cPAN').val());
                $('#disp_cCIN').html($('#cCIN').val());
                $('#disp_cAddress').html($('#cAddress').val());
                $('#disp_cCountry').html($('#cCountry option[value="'+trim($("#cCountry").val())+'"]').html());
                $('#disp_cState').html($('#cState option[value="'+trim($("#cState").val())+'"]').html());
                $('#disp_cCity').html($('#cCity').val());
                $('#disp_cBusinessSpan').html($('#cBusinessSpan').val());
                $('#disp_cBusinessArea').html($('#cBusinessArea').val());
                $('#disp_cRegAddress').html($('#cRegAddress').val());
                $('#disp_cRegPincode').html($('#cRegPincode').val());
                $('#disp_cRegCountry').html($('#cRegCountry option[value="'+trim($("#cRegCountry").val())+'"]').html());
                $('#disp_cRegState').html($('#cRegState option[value="'+trim($("#cRegState").val())+'"]').html());
                $('#disp_cRegCity').html($('#cRegCity').val());
                $('#disp_cTelephone').html($('#cTelephone').val());
                $('#disp_cMobile').html($('#cTelephone').val());
                $('#disp_cFacsimile').html($('#cFacsimile').val());
                $('#disp_cEmail').html($('#cEmail').val());

                $('#tab1_msg').html('Account Details Updated');
                $('#tab1_msg').css('color','#22bb5b');
                $("#display_"+tab).show();
                $("#edit_"+tab).hide();
                alertify.alert("Account Details Updated.", function()
                {
                    alertify.success('Success');
                });
            }
        });
    }
    else if(tab == 'business_details')
    {
        cFirm               = trim($('#cFirm').val());
        cOwnerName          = trim($('#cOwnerName').val());
        cBusinessCategory   = trim($('#cBusinessCategory').val());
        cServices           = trim($('#cServices').val());
        cTurnOver           = trim($('#cTurnOver').val());

        $.post("update_seller_profile.php",{tab:tab,iSeller_id:iSeller_id,cFirm:cFirm,cOwnerName:cOwnerName,cBusinessCategory:cBusinessCategory,cServices:cServices,cTurnOver:cTurnOver},function(data) 
            {
                $('#disp_cFirm').html($('#cFirm').val());
                $('#disp_cOwnerName').html($('#cOwnerName').val());
                $('#disp_cBusinessCategory').html($('#cBusinessCategory').val());
                $('#disp_cServices').html($('#cServices').val());
                $('#disp_cTurnOver').html($('#cTurnOver').val()); 

                $('#tab2_msg').html('Business Details Updated');
                $('#tab2_msg').css('color','#22bb5b');
                $("#display_"+tab).show();
                $("#edit_"+tab).hide();
                alertify.alert("Business Details Updated.", function()
                {
                    alertify.success('Success');
                });
            });


    }
    else if(tab == 'payment')
    {
        cAcc_name           = trim($('#cAcc_name').val());
        cAcc_number         = trim($('#cAcc_number').val());
        cAcc_bankname       = trim($('#cAcc_bankname').val());
        cAcc_bankcity       = trim($('#cAcc_bankcity').val());
        cAcc_bankbranch     = trim($('#cAcc_bankbranch').val());
        cAcc_ifsc           = trim($('#cAcc_ifsc').val());
        $.post("update_seller_profile.php",{tab:tab,iSeller_id:iSeller_id,cAcc_name:cAcc_name,cAcc_number:cAcc_number,cAcc_bankname:cAcc_bankname,cAcc_bankcity:cAcc_bankcity,cAcc_bankbranch:cAcc_bankbranch,cAcc_ifsc:cAcc_ifsc},function(data) 
        {
            if(trim(data) == "updated")
            {
                $('#disp_cAcc_name').html($('#cAcc_name').val());
                $('#disp_cAcc_number').html($('#cAcc_number').val());
                $('#disp_cAcc_bankname').html($('#cAcc_bankname option[value="'+trim($("#cAcc_bankname").val())+'"]').html());
                $('#disp_cAcc_bankcity').html($('#cAcc_bankcity').val());
                $('#disp_cAcc_bankbranch').html($('#cAcc_bankbranch').val());
                $('#disp_cAcc_ifsc').html($('#cAcc_ifsc').val());
                $('#tab3_msg').html('Bank Account Details Updated');
                $('#tab3_msg').css('color','#22bb5b');
                $("#display_"+tab).show();
                $("#edit_"+tab).hide();
                alertify.alert("Bank Account Details Updated.", function()
                {
                    alertify.success('Success');
                });
            }
        });

    }
    else if(tab == 'payment_settlement')
    {
         cPaymentSettlement = $('input:radio[name=cPaymentSettlement]:checked').val();
         cPaymentMode       = $('input:radio[name=cPaymentMode]:checked').val();
         $.post("update_seller_profile.php",{tab:tab,iSeller_id:iSeller_id,cPaymentSettlement:cPaymentSettlement,cPaymentMode:cPaymentMode},function(data) 
        {
            if(trim(data) == "updated")
            {
                $('#disp_cPaymentSettlement').html($('input:radio[name=cPaymentSettlement]:checked').val());
                $('#disp_cPaymentMode').html($('input:radio[name=cPaymentMode]:checked').val());

                $('#tab5_msg').html('Display Information Details Updated');
                $('#tab5_msg').css('color','#22bb5b');
                $("#display_"+tab).show();
                $("#edit_"+tab).hide();
                alertify.alert("Display Information Details Updated.", function()
                {
                    alertify.success('Success');
                });
            }
        });
    }
    else if(tab == 'documents')
    {

    var formData = new FormData();


    if($("#cFirm").val() == 'Proprietor')
    {
        if($('#sdRationcard').val())
        {
            var fileSelect = document.getElementById('sdRationcard');
            var files = fileSelect.files;
            var file = files[0];

            // Add the file to the request.
            formData.append('files[sdRationcard]', file, file.name);
            $('#img_disp_sdRationcard').attr('src',$('#img_sdRationcard').attr('src')); 
        }

        if($('#sdAddressproof').val())
        {
            var fileSelect = document.getElementById('sdAddressproof');
            var files = fileSelect.files;
            var file = files[0];

            // Add the file to the request.
            formData.append('files[sdAddressproof]', file, file.name);
            $('#img_disp_sdAddressproof').attr('src',$('#img_sdAddressproof').attr('src'));
        }

        if($('#sdPan').val())
        {
            var fileSelect = document.getElementById('sdPan');
            var files = fileSelect.files;
            var file = files[0];

            // Add the file to the request.
            formData.append('files[sdPan]', file, file.name);
            $('#img_disp_sdPan').attr('src',$('#img_sdPan').attr('src'));
        }

        if($('#sdReturnIncome').val())
        {
            var fileSelect = document.getElementById('sdReturnIncome');
            var files = fileSelect.files;
            var file = files[0];

            // Add the file to the request.
            formData.append('files[sdReturnIncome]', file, file.name);
            $('#img_disp_sdReturnIncome').attr('src',$('#img_sdReturnIncome').attr('src'));
        }

        if($('#sdBankSignature').val())
        {
            var fileSelect = document.getElementById('sdBankSignature');
            var files = fileSelect.files;
            var file = files[0];

            // Add the file to the request.
            formData.append('files[sdBankSignature]', file, file.name);
            $('#img_disp_sdBankSignature').attr('src',$('#img_sdBankSignature').attr('src'));
        }

    }
    else if($("#cFirm").val() == 'Partnership')
    {
        if($('#pdAddressproof').val())
        {
            var fileSelect = document.getElementById('pdAddressproof');
            var files = fileSelect.files;
            var file = files[0];

            // Add the file to the request.
            formData.append('files[pdAddressproof]', file, file.name);
            $('#img_disp_pdAddressproof').attr('src',$('#img_pdAddressproof').attr('src')); 

        }

        if($('#pdPan').val())
        {
            var fileSelect = document.getElementById('pdPan');
            var files = fileSelect.files;
            var file = files[0];

            // Add the file to the request.
            formData.append('files[pdPan]', file, file.name);
            $('#img_disp_pdPan').attr('src',$('#img_pdPan').attr('src')); 
        }

        if($('#pdReturnIncome').val())
        {
            var fileSelect = document.getElementById('pdReturnIncome');
            var files = fileSelect.files;
            var file = files[0];

            // Add the file to the request.
            formData.append('files[pdReturnIncome]', file, file.name);
            $('#img_disp_pdReturnIncome').attr('src',$('#img_pdReturnIncome').attr('src'));
        }

        if($('#pdPartners').val())
        {
            var fileSelect = document.getElementById('pdPartners');
            var files = fileSelect.files;
            var file = files[0];

            // Add the file to the request.
            formData.append('files[pdPartners]', file, file.name);
            $('#img_disp_pdPartners').attr('src',$('#img_pdPartners').attr('src'));
        }

        if($('#pdRegisteredCertificate').val())
        {
            var fileSelect = document.getElementById('pdRegisteredCertificate');
            var files = fileSelect.files;
            var file = files[0];

            // Add the file to the request.
            formData.append('files[pdRegisteredCertificate]', file, file.name);
            $('#img_disp_pdRegisteredCertificate').attr('src',$('#img_pdRegisteredCertificate').attr('src'));
        }

        if($('#pdBankSignature').val())
        {
            var fileSelect = document.getElementById('pdBankSignature');
            var files = fileSelect.files;
            var file = files[0];

            // Add the file to the request.
            formData.append('files[pdBankSignature]', file, file.name);
            $('#img_disp_pdBankSignature').attr('src',$('#img_pdBankSignature').attr('src'));
        }
    }
    else if($("#cFirm").val() == 'Limited' || $("#cFirm").val() == 'Private Limited')
    {
        if($('#ldRegAddressproof').val())
        {
            var fileSelect = document.getElementById('ldRegAddressproof');
            var files = fileSelect.files;
            var file = files[0];

            // Add the file to the request.
            formData.append('files[ldRegAddressproof]', file, file.name);
            $('#img_disp_ldRegAddressproof').attr('src',$('#img_ldRegAddressproof').attr('src'));
        }

        if($('#ldPan').val())
        {
            var fileSelect = document.getElementById('ldPan');
            var files = fileSelect.files;
            var file = files[0];

            // Add the file to the request.
            formData.append('files[ldPan]', file, file.name);
            $('#img_disp_ldPan').attr('src',$('#img_ldPan').attr('src'));
        }

        if($('#ldPartners').val())
        {
            var fileSelect = document.getElementById('ldPartners');
            var files = fileSelect.files;
            var file = files[0];

            // Add the file to the request.
            formData.append('files[ldPartners]', file, file.name);
            $('#img_disp_ldPartners').attr('src',$('#img_ldPartners').attr('src'));
        }

        if($('#ldBoardResolution').val())
        {
            var fileSelect = document.getElementById('ldBoardResolution');
            var files = fileSelect.files;
            var file = files[0];

            // Add the file to the request.
            formData.append('files[ldBoardResolution]', file, file.name);
            $('#img_disp_ldBoardResolution').attr('src',$('#img_ldBoardResolution').attr('src'));
        }

        if($('#ldCommencementCertificate').val())
        {
            var fileSelect = document.getElementById('ldCommencementCertificate');
            var files = fileSelect.files;
            var file = files[0];

            // Add the file to the request.
            formData.append('files[ldCommencementCertificate]', file, file.name);
            $('#img_disp_ldCommencementCertificate').attr('src',$('#img_ldCommencementCertificate').attr('src')); 
        }

        if($('#ldIncorporationCertificate').val())
        {
            var fileSelect = document.getElementById('ldIncorporationCertificate');
            var files = fileSelect.files;
            var file = files[0];

            // Add the file to the request.
            formData.append('files[ldIncorporationCertificate]', file, file.name);
            $('#img_disp_ldIncorporationCertificate').attr('src',$('#img_ldIncorporationCertificate').attr('src'));
        }

        if($('#ldDIN').val())
        {
            var fileSelect = document.getElementById('ldDIN');
            var files = fileSelect.files;
            var file = files[0];

            // Add the file to the request.
            formData.append('files[ldDIN]', file, file.name);
            $('#img_disp_ldDIN').attr('src',$('#img_ldDIN').attr('src'));
        }

        if($('#ldBankSignature').val())
        {
            var fileSelect = document.getElementById('ldBankSignature');
            var files = fileSelect.files;
            var file = files[0];

            // Add the file to the request.
            formData.append('files[ldBankSignature]', file, file.name);
            $('#img_disp_ldBankSignature').attr('src',$('#img_ldBankSignature').attr('src'));
        }
    }

    if($('#dCompanyProfile').val())
    {
        var fileSelect = document.getElementById('dCompanyProfile');
        var files = fileSelect.files;
        var file = files[0];

        // Add the file to the request.
        formData.append('files[dCompanyProfile]', file, file.name);
        $('#img_disp_dCompanyProfile').attr('src',$('#img_dCompanyProfile').attr('src')); 
    }

    if($('#dVat').val())
    {
        var fileSelect = document.getElementById('dVat');
        var files = fileSelect.files;
        var file = files[0];

        // Add the file to the request.
        formData.append('files[dVat]', file, file.name);
        $('#img_disp_dVat').attr('src',$('#img_dVat').attr('src'));
    }

    if($('#dServiceTax').val())
    {
        var fileSelect = document.getElementById('dServiceTax');
        var files = fileSelect.files;
        var file = files[0];

        // Add the file to the request.
        formData.append('files[dServiceTax]', file, file.name);
        $('#img_disp_dServiceTax').attr('src',$('#img_dServiceTax').attr('src'));
    }

    if($('#dCst').val())
    {
        var fileSelect = document.getElementById('dCst');
        var files = fileSelect.files;
        var file = files[0];

        // Add the file to the request.
        formData.append('files[dCst]', file, file.name);
        $('#img_disp_dCst').attr('src',$('#img_dCst').attr('src'));
    }

    if($('#dEstLicense').val())
    {
        var fileSelect = document.getElementById('dEstLicense');
        var files = fileSelect.files;
        var file = files[0];

        // Add the file to the request.
        formData.append('files[dEstLicense]', file, file.name);
        val = $('#img_dEstLicense').attr('src');
        $('#img_disp_dEstLicense').attr('src',val); 
    }
    // Add the file to the request.
    formData.append('files[]', file, file.name); 
    formData.append('tab', tab);
    formData.append('iSeller_id', iSeller_id);
    formData.append('cFirm', trim($('#cFirm').val()));

    // Set up the request.
    var xhr = new XMLHttpRequest();

    // Open the connection.
    xhr.open('POST', 'update_seller_profile.php', true);

    // Set up a handler for when the request finishes.
    xhr.onload = function (data) 
    {
        if(xhr.status === 200) 
            {
                $('#tab5_msg').html('Display Information Details Updated');
                $('#tab5_msg').css('color','#22bb5b');
                $("#display_"+tab).show();
                $("#edit_"+tab).hide();
                alertify.alert("Display Information Details Updated.", function()
                {
                    alertify.success('Success');
                });
            }
    };

    // Send the Data.
    xhr.send(formData);

    }
    else if(tab == 'pickup')
    {
        cPickup_address    = trim($('#cPickup_address').val());
        cPickup_pincode    = trim($('#cPickup_pincode').val());
        cPickup_country    = trim($('#cPickup_country').val());
        cPickup_state      = trim($('#cPickup_state').val());
        cPickup_city       = trim($('#cPickup_city').val());
        $.post("update_seller_profile.php",{tab:tab,iSeller_id:iSeller_id,cPickup_address:cPickup_address,cPickup_pincode:cPickup_pincode,cPickup_country:cPickup_country,cPickup_state:cPickup_state,cPickup_city:cPickup_city},function(data) 
        {
            if(trim(data) == "updated")
            {
                $('#disp_cPickup_address').html($('#cPickup_address').val());
                $('#disp_cPickup_pincode').html($('#cPickup_pincode').val());
                $('#disp_cPickup_country').html($('#cPickup_country option[value="'+trim($("#cPickup_country").val())+'"]').html());
                $('#disp_cPickup_state').html($('#cPickup_state option[value="'+trim($("#cPickup_state").val())+'"]').html());
                $('#disp_cPickup_city').html($('#cPickup_city').val());
                $('#tab6_msg').html('Pickup Details Updated');
                $('#tab6_msg').css('color','#22bb5b');
                $("#display_"+tab).show();
                $("#edit_"+tab).hide();
                alertify.alert("Pickup Details Updated.", function()
                {
                    alertify.success('Success');
                });
            }
        });
    }
}

function ajaxFileUpload(tab,id,name)
{
    var fileSelect = document.getElementById(id);
    var pan_number = document.getElementById('disp_cPan');
    var files = fileSelect.files;
    var formData = new FormData();
    for (var i = 0; i < files.length; i++) 
    {
        var file = files[i];

        // Add the file to the request.
        formData.append('files[]', file, file.name);
        formData.append('tab', tab);
        formData.append('cPan', pan_number);
        formData.append('name', name);


        // Set up the request.
        var xhr = new XMLHttpRequest();

        // Open the connection.
        xhr.open('POST', 'update_seller_profile.php', true);

        // Set up a handler for when the request finishes.
        xhr.onload = function (data) {
          if (xhr.status === 200) {
            // File(s) uploaded.
           console.log(data);
          } else {
            alert('An error occurred!');
          }
        };

        // Send the Data.
        xhr.send(formData);
    }
}

function readURL(input) 
{
    if (input.files && input.files[0]) 
    {
        var reader = new FileReader();

        reader.onload = function (e) 
        {
            $('#img_'+input.id)
                .attr('src', e.target.result)
                .width(150)
                .height(200);
        };

        reader.readAsDataURL(input.files[0]);
    }
}



function trim(str)
{ 
    return str.replace(/^\s+|\s+$/g,"");
}
