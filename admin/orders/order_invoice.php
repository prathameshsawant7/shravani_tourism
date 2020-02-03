<?php
/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Get product list
*/ 
include("../config/start_session.php");
include("../config/settings.php");
require("../Barcode39.php");
require_once("../MPDF/mpdf.php");
$est =new settings();
$con=$est->connection();


$result             = array();
$orderarr           = array();
$resultarr          = array();
$htmlTable          = '';
$id_order_detail    = $_GET['id_order_detail'];
$id_order           = getOrderID($con,$id_order_detail);
$orderarr           = getOrderdetails($con,$id_order);
$result1            = $orderarr;
$product_details    = getProductsDetailPDF($con,$id_order_detail);
$result2            = $product_details;

$custmarr = array();
$custmarr1 = array();
$addressarr = array();
foreach ($orderarr as $key => $value1) 
{
    $custmarr1 = getCustomersDetails($con,$value1['id_customer']);
    //$country = new Country((int) $value1['id_order_invoice']);
    $formatted_invoice_address  = getFormatedAddress($con,$value1['id_address_invoice']);
    $formatted_delivery_address = getFormatedAddress($con,$value1['id_address_delivery']);
    $addressarr = array($formatted_invoice_address, $formatted_delivery_address);
}
$custmarr = $custmarr1[0];
$custmarr['address'] = $addressarr;
$result3[] = $custmarr;
$result['order' . $id1] = array_merge_recursive($result1,$result2,$result3);
unset($result3);

//echo "<pre>";print_r($result);exit;
 $i = 0;
foreach ($result as $key2 => $value2)
        {
            foreach ($value2 as $key3 => $value3)
            {
                if($key3 == 0)
                {
                    $order_invoice_date3 = $value3['invoice_date'];
                    $shipping_charges = $value3['total_shipping'];
                    //$totalpaid = $value3['total_paid'];
                    $totalpaid = $value3['product_price'];

                    $inwords2=ucfirst(convert_number_to_words($totalpaid));
                    $inwords=str_replace("point zero zero"," Only",$inwords2);
                    //$invoicenumber=$value3['invoice_number'];
                    $taxname = $value3['taxname'];
                    $barcode = $value3['barcode'];
                    $order_no = $value3['id_order'];
                    $invoice_number = $value3['invoice_number'];
                    $total_shipping_tax_excl = $value3['total_shipping_tax_excl'];
                    $payment = $value3['payment'];
                    $orderNumber=$value3['orderNumber'];
                    $total_shipping=$value3['total_shipping'];
                    $total_discounts = $value3['total_discounts'];
                    $invoice_date2 = $value3['date_add'];
                    $invoice_date21 = $value3['date_add'];

                    $invoice_date = date("Y-m-d", strtotime($invoice_date2));
                    //$invoice_date=substr($invoice_date2, 0, strrpos($invoice_date2, ' '));
                    //$order_date=substr($invoice_date2, 0, strrpos($invoice_date2, ' '));
                   //$invoice_date= date_format($invoice_date2, 'Y-m-d');
                    $order_date = date("Y-m-d", strtotime($invoice_date21)); 
                   //$invoice_date= date_format($order_date, 'Y-m-d');
                }
                if($key3 == 1)
                {
                    $invoice_number = $value3['id_order_invoice'];
                    $product_price = $value3['product_price'];
                    $product_supplier_reference = $value3['product_supplier_reference'];
                    $product_name = $value3['product_name'];
                    $product_quantity = $value3['product_quantity'];
                    $tax_name = $value3['tax_name'];
                    $ecotax_tax_rate = $value3['ecotax_tax_rate'];
                    $unit_price_tax_incl = $value3['unit_price_tax_incl'];
                    $unit_price_tax_excl = $value3['unit_price_tax_excl'];
                    //$id_order_detail = $value3['id_order_detail'];
                    $shippingnumber = $value3['trackingNumber'];
                    $tax_rate = $value3['tax_rate'];
                    if($value3['cEst_name'] != '')
                    {
                        $seller_id =$value3['iSeller_id'];
                        $seller_name=$value3['cEst_name'];
                        $seller_address=$value3['cBusiness_address'];
                        $seller_city=$value3['cBusiness_address_city'];
                        $seller_picode=$value3['iBusiness_address_pincode'];
                        $cReg_address=$value3['cReg_address'];
                    }
                    else 
                    {
                        $seller_id      = 1;
                        $seller_name    = "Jewelsouk Marketplace Ltd.";
                        $seller_address = "Laxmi Towers, Office No.A-1,A-Wing, "
                                        . "7th Floor Bandra Kurla Complex,"
                                        . "Bandra (East)";
                        $seller_city    = "Mumbai";
                        $seller_picode  = "400051";
                        $cReg_address   = "Laxmi Towers, Office No.A-1,A-Wing, "
                                        . "7th Floor Bandra Kurla Complex,"
                                        . "Bandra (East)";
                    }
                }
                if($key3 == 2)
                {
                    $invoice_number = $value3['id_order_invoice'];
                    $formatted_invoice_address = $value3['address'][0];
                    $formatted_delivery_address = $value3['address'][1];
                    $name = $value3['firstname'] . ' ' . $value3['lastname'];
                }

            }

             //echo $seller_name.",<br />".$seller_address."<br />".$seller_city.$seller_picode;
             //exit;
            //echo "id_order_detail = ".$id_order_detail;exit;
            $bc = new Barcode39($id_order_detail);
            $bc_awb = new Barcode39($shippingnumber);
            $file="../BarcodeImg/".$id_order_detail.".gif";
            $file2="../BarcodeImg/".$shippingnumber.".gif";
            //if(!mkdir("../BarcodeImg/2.gif",0777)){die("Unable to open file!");}
            $fp = fopen($file, 'w') or die("unable to create file!");
            $fp2 = fopen($file2, 'w') or die("unable to create file");
            fwrite($fp,'');
            fclose($fp);
            fwrite($fp2,'');
            fclose($fp2);
            chmod($file, 0777);
            chmod($file2, 0777);
            $bc->draw("../BarcodeImg/".$id_order_detail.".gif");
            $bc_awb->draw("../BarcodeImg/".$shippingnumber.".gif");



            /*** Barcode Code **********/


            $index = 0;
            $inwrds=ucfirst(convert_number_to_words($unit_price_tax_incl));
            $inwords_price2=str_replace("point zero zero"," Only",$inwrds);    
            $replace_part = substr($inwords_price2, strpos($inwords_price2, "Only") + 4);
            $inwords_price=str_replace($replace_part," ",$inwords_price2);
            $htmlTable.='<table width="1000px" cellspacing="0" cellpadding="5px" style="border:1px solid #000;border-collapse:collapse">
                            <tr>
                                <td width="600px"  align="left" border="0" valign="top">

                                    <table width="600px" border="0" cellspacing="0" cellpadding="3px" style="border:1px solid #000;border-collapse:collapse">


                                        <tr>
                                            <td height="20px" colspan="8" align="center" style="border:1px solid #000;" ><strong>TAX-INVOICE</strong></td>
                                        </tr>
                                        <tr>
                                            <td rowspan="3" colspan="4" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-left:1px solid #000;border-right:1px solid #000;"><p>'.$seller_name.',<br />'.$seller_address.'<br />'.$seller_city.' ,'.$seller_picode.'</p>
                                            </td>
                                            <td height="20px" colspan="4" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;">Invoice Number : ' .$invoice_number. '
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="20px" colspan="4" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;">Order ID : ' .$order_no. '<br></td>
                                        </tr>
                                        <tr>
                                            <td height="20px" colspan="2" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;">Invoice Date : ' .$invoice_date. '</td>
                                            <td height="20px" colspan="2" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;">Order Date: ' .$invoice_date. '</td>
                                        </tr>
                                        <tr>
                                            <td rowspan="5" valign="top" colspan="4" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000; border-left:1px solid #000;">Delivery Address:<br>
                                                                       ' . $formatted_delivery_address . '     
                                                                         <br /> <br /> Invoice Address: ' . $formatted_invoice_address . '
                                            </td>
                                            <td height="28px" colspan="4" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;">Suppliers Reference No. : ' . $product_supplier_reference . '</td>
                                        </tr>
                                        <tr>
                                            <td height="20px" colspan="4" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;">Buyers Order No. : '.$orderNumber.'</td>
                                        </tr>
                                        <tr>
                                            <td height="20px" colspan="4" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;">Payment Method:' . $payment . '  <br>
                                                Price:' .$unit_price_tax_incl . '

                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="72px" colspan="4" align="center" valign="top" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"><p>Order Barcode</p>
                                                <p><img src="../BarcodeImg/'.$id_order_detail.'.gif"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="83px" colspan="4" align="center" valign="top" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"><p>AWB Barcode (Hand Delivery)</p>
                                                <p><img src="../BarcodeImg/'.$shippingnumber.'.gif" /></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="20px" colspan="8" align="center"style="border:1px solid #000;border-right:1px solid #000; border-left:1px solid #000;">Products Description</td>
                                        </tr>

                                        <tr>
                                            <td width="20px" height="20px" valign="top" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;border-left:1px solid #000;">
                                                SR<br>No
                                            </td>
                                            <td width="200px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;" valign="top">
                                                Product Name
                                            </td>
                                            <td width="5px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;" valign="top">
                                                Qty
                                            </td>
                                            <td width="75px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;" valign="top">
                                                Unit Price Tax<br>Excl.
                                            </td>
                                            <td width="75px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;" valign="top">
                                                Tax Rate
                                            </td>
                                            <td width="75px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;" valign="top">
                                                Tax<br>Amount
                                            </td>
                                            <td width="75px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;" valign="top">
                                                Unit Price Tax<br>Incl. (INR)
                                            </td>
                                            <td width="75px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;" valign="top">
                                                Amount<br>(INR)...
                                            </td>
                                        </tr>';

                    $htmlTable.='<tr>
                                        <td height="20px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000; border-right:1px solid #000; border-left:1px solid #000;">' . ($index + 1) . 
                                         '</td>
                                        <td height="20px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000; border-right:1px solid #000;">' . $product_name. '</td>
                                        <td height="20px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000; border-right:1px solid #000;" align="center">' . $product_quantity . '</td>
                                        <td height="20px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000; border-right:1px solid #000;">' .$unit_price_tax_excl. '
                                        </td>
                                        <td height="20px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000; border-right:1px solid #000;">' . $tax_rate . '</td>
                                        <td height="20px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000; border-right:1px solid #000;">' . $ecotax_tax_rate.'</td>
                                        <td height="20px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000; border-right:1px solid #000;">'. $unit_price_tax_incl.'</td>
                                        <td height="20px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000; border-right:1px solid #000;">' . $unit_price_tax_incl.'</td>
                                     </tr>';
                $index++;

                     $htmlTable.='<tr>
                                            <td height="46px" colspan="8" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000; border-left:1px solid #000;"><p> </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td height="15px" colspan="2" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"><strong>' . $unit_price_tax_incl. '</strong></td>
                                            <td height="15px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"></td>
                                            <td height="15px" colspan="4" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"></td>
                                            <td height="15px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;">'.$total_shipping.'</td>
                                        </tr>

                                        <tr>
                                            <td height="15px" colspan="2" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;border-left:1px solid #000;">Voucher Discount</td>
                                            <td height="15px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"></td>
                                            <td height="15px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"></td>
                                            <td height="15px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"></td>
                                            <td height="15px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"></td>
                                            <td height="15px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"></td>
                                            <td height="15px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;">'. $total_discounts.'</td>
                                        </tr>
                                        <tr>
                                            <td height="15px" colspan="2" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000; border-left:1px solid #000;">Shipping Charges 


                                            </td>
                                            <td height="15px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"></td>
                                            <td height="15px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"></td>
                                            <td height="15px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"></td>
                                            <td height="15px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"></td>
                                            <td height="15px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"></td>
                                            <td height="15px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;">'. $total_shipping. '</td>
                                        </tr>
                                        <tr>
                                            <td height="15px" colspan="2" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;border-left:1px solid #000;">Total Paid </td>
                                            <td height="15px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"></td>
                                            <td height="15px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"></td>
                                            <td height="15px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"></td>
                                            <td height="15px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"></td>
                                            <td height="15px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"></td>
                                            <td height="15px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;">' .$totalpaid. '</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000; border-left:1px solid #000;">Amount Chargeable (in words)<br>
                                                INR </td>
                                            <td height="20px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"></td>
                                            <td height="20px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"></td>
                                            <td height="20px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"></td>
                                            <td height="20px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"></td>
                                            <td height="20px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;"></td>
                                            <td height="20px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000;">'.$inwords_price.'</td>
                                        </tr>
                                        <tr>
                                        <td width="400px" align="left" colspan="8">Companys VAT TIN : 27320355665V<br>
                                            Companys CST No. : 27320355665C<br>
                                            Companys PAN : AAACM8157B<br>
                                            CIN : U74120MH1989PLC054232</td>
                                            </tr>
                                            <tr>
                                        <td width="200px" align="right" colspan="4">For '.$seller_name.'</td>
                                        <td width="200px" align="right" colspan="4">Authorised Signatory</td>

                                    </tr>
                                    <tr>
                                        <td align="justify" width="400px" colspan="8">Declaration :<br>
                                            I/We hereby certify that my/our registration certification under<br>
                                            the Maharashtra Value Added Tax Act, 2002 is in force on the<br>
                                            date on which the sale of goods specified in this &quot;Tax Invoice&quot; is<br>
                                            made by me/us and that the transaction of sale covered by this<br>
                                            &quot;Tax has been effected by me/us and it shall be accounted for<br>
                                            in the turnover of sales while filling of returns and the due tax, if<br>
                                            any, payable on the sale has been paid or shall be paid.</td>

                                    </tr>
                                    <tr>
                                        <td colspan="8" align="center" width="600px">Communication Address:: '.$seller_name.',<br />'.$seller_address.'<br />'.$seller_city.' ,'.$seller_picode.'
                                        </td>
                                    </tr>
                                                </table>
                                        </td>
                                    </tr>';

            $htmlTable.='<td width="400px" align="right" valign="top">
                        <table width="400px" border="0" cellspacing="0" cellpadding="3px" style="border:1px solid #000;border-collapse:collapse">
                            <tr>
                                <td colspan="2" align="center" style="border:1px solid #000;"><img src="../img/seller_logo/logo-1.jpg" ></td>
                            </tr>
                            <tr>
                                  <td width="400px" colspan="2" style=" font-size:12px; border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000; border-left:1px solid #000;">Order Barcode &nbsp; | &nbsp;  '.$barcode.'</td>

                            </tr>
                            <tr>
                                <td height="90" colspan="2" align="center" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000; border-left:1px solid #000;"><img src="../BarcodeImg/'.$id_order_detail.'.gif" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="font-size:12px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000; border-left:1px solid #000;">Delivery Address:<br>
                                  ' . $formatted_delivery_address . '

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center" style="font-size:12px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000; border-left:1px solid #000;">If not deliverred return to '.$seller_name.',<br />'.
                                $cReg_address.' ,'.$seller_picode.'</td>
                            </tr>
                            <tr>
                                <td colspan="2" height="30px" style="font-size:12px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000; border-left:1px solid #000;">AWB Barcode(Hand Delivery)</td>
                            </tr>
                            <tr>
                                <td colspan="2" height="80px" align="center" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000; border-left:1px solid #000;"><img src="../BarcodeImg/'.$shippingnumber.'.gif" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="left" height="30px" style="font-size:12px" style="border-bottom:0.5px solid #000;border-top:0.5px solid #000;border-right:1px solid #000; border-left:1px solid #000;"><p align="center"><strong><u>Declaration cum Authority Letter</u></strong></p>
                                    <p>Date: ' .$invoice_date. '</p>
                                    <p>The imitation in transit is the property of Jewelsouk Market Place
                                    Limited. and is of no commercial value and is not for sale.
                                    Consignment value is Rs. 213/- They are being transferred to the
                                    shipping address as mentioned above. We authorize Hand
                                    Deslivery company to carry the same on our behalf.</p>
                                    <p>Thank you, in anticipation.</p>


                                    <p>Your sincerely,</p>
                                    <p>For '.$seller_name.'<br />'.'</p>
                                    <p></p>
                                    <p></p>


                                    <p>Authorized Signatory</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </table>';

        }



$mpdf = new mPDF();
$mpdf->WriteHTML($htmlTable);
$mpdf->Output("order-invoice.pdf","D");

function getFormatedAddress($con,$id)
{
    $query =  "SELECT firstname,lastname,address1,address2,postcode,city "
            . "FROM `js_address` "
            . "WHERE `id_address` = $id";

    $fetch_data   = mysqli_query($con,$query);
    $aData        = $fetch_data->fetch_assoc();
    if($aData)
    {
        $result   = $aData['firstname']." ".$aData['lastname']."<BR>"
                . $aData['address1']."<BR>"
                . $aData['address2']."<BR>"
                . $aData['city'].", ". $aData['postcode'];
    }
    else
        $result = '';
    return $result;
    
}
function getOrderID($con,$id_order_detail)
{
    $query =  "SELECT id_order FROM js_order_detail "
            . "WHERE id_order_detail = $id_order_detail;";
    //echo $query;
    $fetch_data   = mysqli_query($con,$query);
    $aData        = $fetch_data->fetch_assoc();
    
    return $aData['id_order'];
}

function getProductsDetailPDF($con,$id_order_detail)
{
    $i = 0;
    $result = array();
    $query = "SELECT od.*,p.*,od.id_order_detail,od.id_order,od.id_order_invoice,"
            . "od.id_warehouse,js.cEst_name,js.cBusiness_address,js.cBusiness_address_city,"
            . "js.iBusiness_address_pincode,js.cReg_address "
            . "FROM `js_order_detail` od "
            . "LEFT JOIN `js_order_product_info` p ON p.id_order_detail = od.id_order_detail "
            . "LEFT JOIN js_seller js on od.iSeller_id=js.iSeller_id                 "
            . "WHERE od.`id_order_detail` = '".$id_order_detail."'";
        
    $fetch_data = mysqli_query($con,$query);   
    while($aData = $fetch_data->fetch_assoc())
    {
        $result[$i] = $aData;
        $i++;
    }
    //echo "<pre>";print_r($result);
    return $result;
}

function getCustomersDetails($con,$id_customer)
{
    $i = 0;
    $result = array();
    $query = "SELECT * FROM `js_customer` WHERE id_customer='".$id_customer."' ORDER BY `id_customer` ASC";
    $fetch_data = mysqli_query($con,$query);   
    while($aData = $fetch_data->fetch_assoc())
    {
        $result[$i] = $aData;
        $i++;
    }
    return $result;
}


function getOrderdetails($con,$id_order) 
{
    $i = 0;
    $result = array();
    $query  = "SELECT * FROM `js_orders` WHERE `id_order` = '$id_order'";

    $fetch_data = mysqli_query($con,$query);   
    while($aData = $fetch_data->fetch_assoc())
    {
        $result[$i] = $aData;
        $i++;
    }
    return $result;
}
function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}




?>            