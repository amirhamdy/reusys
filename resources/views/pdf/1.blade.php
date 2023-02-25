<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> INVOICE </title>
    <meta name="robots" content="noindex,nofollow" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">

    <!-- Invoice styling -->
    <style>
        body { margin: 0; padding: 0; background: #e1e1e1; }
        div, p, a, li, td { -webkit-text-size-adjust: none; }
        .ReadMsgBody { width: 100%; background-color: #ffffff; }
        .ExternalClass { width: 100%; background-color: #ffffff; }
        body { width: 100%; height: 100%; background-color: #e4e1e1; margin: 0; padding: 0; -webkit-font-smoothing: antialiased; }
        html { width: 100%; }
        p { padding: 0 !important; margin-top: 0 !important; margin-right: 0 !important; margin-bottom: 0 !important; margin-left: 0 !important; }
        .visibleMobile { display: none; }
        .hiddenMobile { display: block; }

        @media only screen and (max-width: 600px) {
            body { width: auto !important; }
            table[class=fullTable] { width: 96% !important; clear: both; }
            table[class=fullPadding] { width: 85% !important; clear: both; }
            table[class=col] { width: 45% !important; }
            .erase { display: none; }
        }

        @media only screen and (max-width: 420px) {
            table[class=fullTable] { width: 100% !important; clear: both; }
            table[class=fullPadding] { width: 85% !important; clear: both; }
            table[class=col] { width: 100% !important; clear: both; }
            table[class=col] td { text-align: left !important; }
            .erase { display: none; font-size: 0; max-height: 0; line-height: 0; padding: 0; }
            .visibleMobile { display: block !important; }
            .hiddenMobile { display: none !important; }
        }
    </style>
</head>

<body>

<!-- Header -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">
    <tr>
        <td height="10"></td>
    </tr>
    <tr>
        <td>
            <table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff" style="border-radius: 10px 10px 0 0;">
                <tr class="hiddenMobile">
                    <td height="40"></td>
                </tr>
                <tr class="visibleMobile">
                    <td height="30"></td>
                </tr>

                <tr>
                    <td>
                        <table width="580" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                            <tbody>
                            <tr>
                                <td>
                                    <table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="col">
                                        <tbody>
                                        <tr>
                                            <td align="left"> <img src="{{ asset('images/logo.png') }}" width="200" height="60" alt="logo" border="0" /></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table width="220" border="0" cellpadding="0" cellspacing="0" align="right" class="col">
                                        <tbody>
                                        <tr class="visibleMobile">
                                            <td height="20"></td>
                                        </tr>
                                        <tr>
                                            <td height="5"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 21px; color: #ff0000; letter-spacing: -1px; font-family: 'Open Sans', sans-serif; line-height: 1; vertical-align: top; text-align: right;">
                                                Reutrans Invoice
                                            </td>
                                        </tr>
                                        <tr>
                                        <tr class="hiddenMobile">
                                            <td height="20"></td>
                                        </tr>
                                        <tr class="visibleMobile">
                                            <td height="20"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 12px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: top; text-align: right;">
                                                <small>INVOICE</small> #800000025<br />
                                                <small>MARCH 4TH 2016</small>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">
    <tbody>
    <tr>
        <td>
            <table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
                <tbody>
                <tr>
                <tr class="hiddenMobile">
                    <td height="30"></td>
                </tr>
                <tr class="visibleMobile">
                    <td height="40"></td>
                </tr>
                <tr>
                    <td>
                        <table width="580" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                            <tbody>
                            <tr>
                                <td>
                                    <table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="col">

                                        <tbody>
                                        <tr>
                                            <td style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                                                <strong>REUTRANS</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="100%" height="10"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 20px; vertical-align: top; ">
                                                Public Wales, Somewhere<br> Germany<br> 4468, Berlin
                                                <br>
                                                <a href="mailto:info@reutrans.com" style="color:#b0b0b0;">info@reutrans.com</a>
                                                <br>
                                                <a href="https://www.reutrans.com/" style="color:#b0b0b0;">www.reutrans.com</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>


                                    <table width="220" border="0" cellpadding="0" cellspacing="0" align="right" class="col">
                                        <tbody>
                                        <tr class="visibleMobile">
                                            <td height="20"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                                                <strong>CUSTOMER DETAILS</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="100%" height="10"></td>
                                        </tr>
                                        {{-- HERE-1 there is a replacment here --}}
                                        <tr>
                                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 20px; vertical-align: top;">
                                                ---c_name---<br>---c_email---<br>---c_address---<br>---c_phone---<br>---c_country---
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr class="hiddenMobile">
                    <td height="30"></td>
                </tr>
                <tr class="visibleMobile">
                    <td height="30"></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<!-- /Header -->


<!-- Project Details -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">
    <tbody>
    <tr>
        <td>
            <table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
                <tbody>
                <tr>
                <tr class="hiddenMobile">
                    <td height="10"></td>
                </tr>
                <tr class="visibleMobile">
                    <td height="20"></td>
                </tr>
                <tr>
                    <td>
                        <table width="580" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                            <thead>
                            <tr>
                                <td style="font-size: 16px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                                    <strong>PROJECT DETAILS</strong>
                                </td>
                                <td height="20"></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td height="10" colspan="4"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #ff0000;  line-height: 14px;  vertical-align: top; padding:5px 0;" class="article">
                                    Project Name
                                </td>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 14px;  vertical-align: top; padding:5px 0;">
                                    This is a project name for testing purposes only
                                </td>
                            </tr>
                            <tr>
                                <td height="1" colspan="4" style="border-bottom:1px solid #e4e4e4"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #ff0000;  line-height: 14px;  vertical-align: top; padding:5px 0;" class="article">Source Language(s)</td>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 14px;  vertical-align: top; padding:5px 0;"><small>MHDV2G/A</small></td>
                            </tr>
                            <tr>
                                <td height="1" colspan="4" style="border-bottom:1px solid #e4e4e4"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #ff0000;  line-height: 14px;  vertical-align: top; padding:5px 0;" class="article">Target Language(s)</td>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 14px;  vertical-align: top; padding:5px 0;"><small>MHDV2G/A</small></td>
                            </tr>
                            <tr>
                                <td height="1" colspan="4" style="border-bottom:1px solid #e4e4e4"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #ff0000;  line-height: 14px;  vertical-align: top; padding:5px 0;" class="article">P.O Number</td>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 14px;  vertical-align: top; padding:5px 0;"><small>MHDV2G/A</small></td>
                            </tr>
                            <tr>
                                <td height="1" colspan="4" style="border-bottom:1px solid #e4e4e4"></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="20"></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<!-- /Project Details -->

<!-- Payment Details -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">
    <tbody>
    <tr>
        <td>
            <table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
                <tbody>
                <tr>
                <tr class="hiddenMobile">
                    <td height="10"></td>
                </tr>
                <tr class="visibleMobile">
                    <td height="20"></td>
                </tr>
                <tr>
                    <td>
                        <table width="580" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                            <thead>
                            <tr>
                                <td style="font-size: 16px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                                    <strong>PAYMENT DETAILS</strong>
                                </td>
                                <td height="20"></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td height="10" colspan="4"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #ff0000;  line-height: 14px;  vertical-align: top; padding:5px 0;" class="article">
                                    {{123}} Count
                                </td>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 14px;  vertical-align: top; padding:5px 0;">
                                    {{1234}}
                                </td>
                            </tr>
                            <tr>
                                <td height="1" colspan="4" style="border-bottom:1px solid #e4e4e4"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #ff0000;  line-height: 14px;  vertical-align: top; padding:5px 0;" class="article">
                                    Total Cost
                                </td>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 14px;  vertical-align: top; padding:5px 0;">
                                    {{1234}}
                                </td>
                            </tr>
                            <tr>
                                <td height="1" colspan="4" style="border-bottom:1px solid #e4e4e4"></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="20"></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<!-- /Payment Details -->

<!-- Bank Details -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">
    <tbody>
    <tr>
        <td>
            <table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff">
                <tbody>
                <tr>
                <tr class="hiddenMobile">
                    <td height="10"></td>
                </tr>
                <tr class="visibleMobile">
                    <td height="20"></td>
                </tr>
                <tr>
                    <td>
                        <table width="580" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                            <thead>
                            <tr>
                                <td style="font-size: 16px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; ">
                                    <strong>BANK DETAILS</strong>
                                </td>
                                <td height="20"></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td height="10" colspan="4"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #ff0000;  line-height: 14px;  vertical-align: top; padding:5px 0;" class="article">
                                    Bank Name
                                </td>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 14px;  vertical-align: top; padding:5px 0;">
                                    {{1234}}
                                </td>
                            </tr>
                            <tr>
                                <td height="1" colspan="4" style="border-bottom:1px solid #e4e4e4"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #ff0000;  line-height: 14px;  vertical-align: top; padding:5px 0;" class="article">
                                    Account Name
                                </td>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 14px;  vertical-align: top; padding:5px 0;">
                                    {{1234}}
                                </td>
                            </tr>
                            <tr>
                                <td height="1" colspan="4" style="border-bottom:1px solid #e4e4e4"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #ff0000;  line-height: 14px;  vertical-align: top; padding:5px 0;" class="article">
                                    Account Number
                                </td>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 14px;  vertical-align: top; padding:5px 0;">
                                    {{1234}}
                                </td>
                            </tr>
                            <tr>
                                <td height="1" colspan="4" style="border-bottom:1px solid #e4e4e4"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #ff0000;  line-height: 14px;  vertical-align: top; padding:5px 0;" class="article">
                                    Swift Code
                                </td>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 14px;  vertical-align: top; padding:5px 0;">
                                    {{1234}}
                                </td>
                            </tr>
                            <tr>
                                <td height="1" colspan="4" style="border-bottom:1px solid #e4e4e4"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #ff0000;  line-height: 14px;  vertical-align: top; padding:5px 0;" class="article">
                                    Bank Country
                                </td>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 14px;  vertical-align: top; padding:5px 0;">
                                    {{1234}}
                                </td>
                            </tr>
                            <tr>
                                <td height="1" colspan="4" style="border-bottom:1px solid #e4e4e4"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #ff0000;  line-height: 14px;  vertical-align: top; padding:5px 0;" class="article">
                                    Bank Guidelines
                                </td>
                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:5px 0;">
                                    Only ACH (US local bank) transfers in USD can be accepted
                                    <br>
                                    Transfers must be made from a company account
                                    <br>
                                    Transfers from individuals will be automatically rejected
                                    <br>
                                    Wire transfers are not supported
                                    <br>
                                    Transfers made from a company account owned by you cannot be accepted
                                </td>
                            </tr>
                            <tr>
                                <td height="1" colspan="4" style="border-bottom:1px solid #e4e4e4"></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="20"></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<!-- /Bank Details -->

<!-- Footer -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#e1e1e1">

    <tr>
        <td>
            <table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable" bgcolor="#ffffff" style="border-radius: 0 0 10px 10px;">
                <tr>
                    <td>
                        <table width="580" border="0" cellpadding="0" cellspacing="0" align="center" class="fullPadding">
                            <tbody>
                            <tr>
                                <td style="font-size: 12px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: top; text-align: left;">
                                    <br>
                                    <a href="mailto:info@reutrans.com" style="color:#b0b0b0;">info@reutrans.com</a>
                                    <br>
                                    <a href="https://www.reutrans.com/" style="color:#b0b0b0;">www.reutrans.com</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr class="spacer">
                    <td height="50"></td>
                </tr>

            </table>
        </td>
    </tr>
    <tr>
        <td height="20"></td>
    </tr>
</table>
<!-- /Footer -->

</body>
</html>
