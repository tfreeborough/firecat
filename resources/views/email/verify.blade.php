@extends('email.base')

@extends('email.banner')

@section('content')
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>
        <!--[if gte mso 9]><xml>
            <o:OfficeDocumentSettings>
                <o:AllowPNG/>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml><![endif]-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width">
        <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
        <title>Verify Your Account</title>
        <!--[if !mso]><!-- -->
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
        <!--<![endif]-->

        <style type="text/css" id="media-query">
            body {
                margin: 0;
                padding: 0; }

            table, tr, td {
                vertical-align: top;
                border-collapse: collapse; }

            .ie-browser table, .mso-container table {
                table-layout: fixed; }

            * {
                line-height: inherit; }

            a[x-apple-data-detectors=true] {
                color: inherit !important;
                text-decoration: none !important; }

            [owa] .img-container div, [owa] .img-container button {
                display: block !important; }

            [owa] .fullwidth button {
                width: 100% !important; }

            [owa] .block-grid .col {
                display: table-cell;
                float: none !important;
                vertical-align: top; }

            .ie-browser .num12, .ie-browser .block-grid, [owa] .num12, [owa] .block-grid {
                width: 500px !important; }

            .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
                line-height: 100%; }

            .ie-browser .mixed-two-up .num4, [owa] .mixed-two-up .num4 {
                width: 164px !important; }

            .ie-browser .mixed-two-up .num8, [owa] .mixed-two-up .num8 {
                width: 328px !important; }

            .ie-browser .block-grid.two-up .col, [owa] .block-grid.two-up .col {
                width: 250px !important; }

            .ie-browser .block-grid.three-up .col, [owa] .block-grid.three-up .col {
                width: 166px !important; }

            .ie-browser .block-grid.four-up .col, [owa] .block-grid.four-up .col {
                width: 125px !important; }

            .ie-browser .block-grid.five-up .col, [owa] .block-grid.five-up .col {
                width: 100px !important; }

            .ie-browser .block-grid.six-up .col, [owa] .block-grid.six-up .col {
                width: 83px !important; }

            .ie-browser .block-grid.seven-up .col, [owa] .block-grid.seven-up .col {
                width: 71px !important; }

            .ie-browser .block-grid.eight-up .col, [owa] .block-grid.eight-up .col {
                width: 62px !important; }

            .ie-browser .block-grid.nine-up .col, [owa] .block-grid.nine-up .col {
                width: 55px !important; }

            .ie-browser .block-grid.ten-up .col, [owa] .block-grid.ten-up .col {
                width: 50px !important; }

            .ie-browser .block-grid.eleven-up .col, [owa] .block-grid.eleven-up .col {
                width: 45px !important; }

            .ie-browser .block-grid.twelve-up .col, [owa] .block-grid.twelve-up .col {
                width: 41px !important; }

            @media only screen and (min-width: 520px) {
                .block-grid {
                    width: 500px !important; }
                .block-grid .col {
                    vertical-align: top; }
                .block-grid .col.num12 {
                    width: 500px !important; }
                .block-grid.mixed-two-up .col.num4 {
                    width: 164px !important; }
                .block-grid.mixed-two-up .col.num8 {
                    width: 328px !important; }
                .block-grid.two-up .col {
                    width: 250px !important; }
                .block-grid.three-up .col {
                    width: 166px !important; }
                .block-grid.four-up .col {
                    width: 125px !important; }
                .block-grid.five-up .col {
                    width: 100px !important; }
                .block-grid.six-up .col {
                    width: 83px !important; }
                .block-grid.seven-up .col {
                    width: 71px !important; }
                .block-grid.eight-up .col {
                    width: 62px !important; }
                .block-grid.nine-up .col {
                    width: 55px !important; }
                .block-grid.ten-up .col {
                    width: 50px !important; }
                .block-grid.eleven-up .col {
                    width: 45px !important; }
                .block-grid.twelve-up .col {
                    width: 41px !important; } }

            @media (max-width: 520px) {
                .block-grid, .col {
                    min-width: 320px !important;
                    max-width: 100% !important;
                    display: block !important; }
                .block-grid {
                    width: calc(100% - 40px) !important; }
                .col {
                    width: 100% !important; }
                .col > div {
                    margin: 0 auto; }
                img.fullwidth, img.fullwidthOnMobile {
                    max-width: 100% !important; }
                .no-stack .col {
                    min-width: 0 !important;
                    display: table-cell !important; }
                .no-stack.two-up .col {
                    width: 50% !important; }
                .no-stack.mixed-two-up .col.num4 {
                    width: 33% !important; }
                .no-stack.mixed-two-up .col.num8 {
                    width: 66% !important; }
                .no-stack.three-up .col.num4 {
                    width: 33% !important; }
                .no-stack.four-up .col.num3 {
                    width: 25% !important; } }

        </style>
    </head>
    <body class="clean-body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #FFFFFF">
    <style type="text/css" id="media-query-bodytag">
        @media (max-width: 520px) {
            .block-grid {
                min-width: 320px!important;
                max-width: 100%!important;
                width: 100%!important;
                display: block!important;
            }

            .col {
                min-width: 320px!important;
                max-width: 100%!important;
                width: 100%!important;
                display: block!important;
            }

            .col > div {
                margin: 0 auto;
            }

            img.fullwidth {
                max-width: 100%!important;
            }
            img.fullwidthOnMobile {
                max-width: 100%!important;
            }
            .no-stack .col {
                min-width: 0!important;
                display: table-cell!important;
            }
            .no-stack.two-up .col {
                width: 50%!important;
            }
            .no-stack.mixed-two-up .col.num4 {
                width: 33%!important;
            }
            .no-stack.mixed-two-up .col.num8 {
                width: 66%!important;
            }
            .no-stack.three-up .col.num4 {
                width: 33%!important
            }
            .no-stack.four-up .col.num3 {
                width: 25%!important
            }
        }
    </style>
    <!--[if IE]><div class="ie-browser"><![endif]-->
    <!--[if mso]><div class="mso-container"><![endif]-->
    <table class="nl-container" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #FFFFFF;width: 100%" cellpadding="0" cellspacing="0">
        <tbody>
        <tr style="vertical-align: top">
            <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #FFFFFF;"><![endif]-->

                <div style="background-color:#218884;">
                    <div style="Margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;" class="block-grid ">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:#218884;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 500px;"><tr class="layout-full-width" style="background-color:transparent;"><![endif]-->

                            <!--[if (mso)|(IE)]><td align="center" width="500" style=" width:500px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="col num12" style="min-width: 320px;max-width: 500px;display: table-cell;vertical-align: top;">
                                <div style="background-color: transparent; width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->


                                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;"><![endif]-->
                                        <div style="color:#555555;line-height:120%;font-family:'Roboto', Tahoma, Verdana, Segoe, sans-serif; padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;">
                                            <div style="font-size:12px;line-height:14px;color:#555555;font-family:'Roboto', Tahoma, Verdana, Segoe, sans-serif;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 14px;text-align: left"><span style="font-size: 36px; line-height: 43px;"><span style="color: rgb(255, 184, 127); font-size: 36px; line-height: 43px;">FIRE</span><span style="color: rgb(255, 255, 255); font-size: 36px; line-height: 43px;"><strong>CAT</strong></span></span></p></div>
                                        </div>
                                        <!--[if mso]></td></tr></table><![endif]-->


                                        <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                        </div>
                    </div>
                </div>    <div style="background-color:transparent;">
                    <div style="Margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;" class="block-grid mixed-two-up ">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 500px;"><tr class="layout-full-width" style="background-color:transparent;"><![endif]-->

                            <!--[if (mso)|(IE)]><td align="center" width="167" style=" width:167px; padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="col num4" style="display: table-cell;vertical-align: top;max-width: 320px;min-width: 164px;">
                                <div style="background-color: transparent; width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->


                                        <div align="center" class="img-container center fixedwidth" style="padding-right: 0px;  padding-left: 0px;">
                                            <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px;" align="center"><![endif]-->
                                            <img class="center fixedwidth" align="center" border="0" src="images/emails/verify/6efc4a0c-05ca-41be-b23a-2ff0b88a8d42.png" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: 0;height: auto;float: none;width: 100%;max-width: 167px" width="167">
                                            <!--[if mso]></td></tr></table><![endif]-->
                                        </div>


                                        <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td><td align="center" width="333" style=" width:333px; padding-right: 0px; padding-left: 0px; padding-top:20px; padding-bottom:5px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="col num8" style="display: table-cell;vertical-align: top;min-width: 320px;max-width: 328px;">
                                <div style="background-color: transparent; width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:20px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->


                                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 25px; padding-bottom: 10px;"><![endif]-->
                                        <div style="color:#FFB87F;line-height:120%;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif; padding-right: 10px; padding-left: 10px; padding-top: 25px; padding-bottom: 10px;">
                                            <div style="line-height:14px;font-size:12px;color:#FFB87F;font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif;text-align:left;"><p style="margin: 0;line-height: 14px;text-align: center;font-size: 12px"><span style="font-size: 36px; line-height: 43px;"><strong>We just want to say... Thanks!</strong></span></p></div>
                                        </div>
                                        <!--[if mso]></td></tr></table><![endif]-->


                                        <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                        </div>
                    </div>
                </div>    <div style="background-color:#ECECEC;">
                    <div style="Margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;" class="block-grid ">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:#ECECEC;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 500px;"><tr class="layout-full-width" style="background-color:transparent;"><![endif]-->

                            <!--[if (mso)|(IE)]><td align="center" width="500" style=" width:500px; padding-right: 0px; padding-left: 0px; padding-top:30px; padding-bottom:30px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="col num12" style="min-width: 320px;max-width: 500px;display: table-cell;vertical-align: top;">
                                <div style="background-color: transparent; width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:30px; padding-bottom:30px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->


                                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 10px;"><![endif]-->
                                        <div style="color:#2C2D37;line-height:150%;font-family:'Roboto', Tahoma, Verdana, Segoe, sans-serif; padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 10px;">
                                            <div style="font-size:12px;line-height:18px;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;color:#2C2D37;text-align:left;"><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: center">&#160;<br></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: center"><span style="font-size: 18px; line-height: 27px;">Hi There, thanks for signing up, before we can get you into your account, we just need to verify that its actually&#160;<strong>you&#160;</strong>﻿who signed up. Once you have verified your account, you will be automatically logged in to your account and you can start working!</span></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: center"><span style="font-size: 18px; line-height: 27px;">&#160;</span><br></p><p style="margin: 0;font-size: 12px;line-height: 18px;text-align: center"><span style="font-size: 18px; line-height: 27px;">To confirm your email address, simply click on the button below.</span></p></div>
                                        </div>
                                        <!--[if mso]></td></tr></table><![endif]-->




                                        <div align="center" class="button-container center" style="padding-right: 10px; padding-left: 10px; padding-top:15px; padding-bottom:10px;">
                                            <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top:15px; padding-bottom:10px;" align="center"><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="" style="height:42px; v-text-anchor:middle; width:168px;" arcsize="60%" strokecolor="#FFB87F" fillcolor="#FFB87F"><w:anchorlock/><center style="color:#ffffff; font-family:Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size:16px;"><![endif]-->
                                            <a href="{{ URL::to('/verify/' . $user->email_verification_code) }}">
                                                <div style="color: #ffffff; background-color: #FFB87F; border-radius: 25px; -webkit-border-radius: 25px; -moz-border-radius: 25px; max-width: 168px; width: 128px;width: auto; border-top: 0px solid transparent; border-right: 0px solid transparent; border-bottom: 0px solid transparent; border-left: 0px solid transparent; padding-top: 5px; padding-right: 20px; padding-bottom: 5px; padding-left: 20px; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; text-align: center; mso-border-alt: none;">
                                                    <span style="font-size:16px;line-height:32px;"><strong><span style="font-size: 14px; line-height: 28px;" data-mce-style="font-size: 14px; line-height: 28px;">Verify My Account</span></strong></span>
                                                </div>
                                            </a>
                                            <!--[if mso]></center></v:roundrect></td></tr></table><![endif]-->
                                        </div>



                                        <div style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;">
                                            <!--[if (mso)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px;padding-left: 10px; padding-top: 10px; padding-bottom: 10px;"><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0"><tr><td><![endif]-->
                                            <div align="center"><div style="border-top: 0px solid transparent; width:100%; line-height:0px; height:0px; font-size:0px;">&#160;</div></div>
                                            <!--[if (mso)]></td></tr></table></td></tr></table><![endif]-->
                                        </div>


                                        <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                        </div>
                    </div>
                </div>    <div style="background-color:#218884;">
                    <div style="Margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;" class="block-grid ">
                        <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:#218884;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 500px;"><tr class="layout-full-width" style="background-color:transparent;"><![endif]-->

                            <!--[if (mso)|(IE)]><td align="center" width="500" style=" width:500px; padding-right: 0px; padding-left: 0px; padding-top:30px; padding-bottom:30px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                            <div class="col num12" style="min-width: 320px;max-width: 500px;display: table-cell;vertical-align: top;">
                                <div style="background-color: transparent; width: 100% !important;">
                                    <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:30px; padding-bottom:30px; padding-right: 0px; padding-left: 0px;"><!--<![endif]-->



                                        <div align="center" style="padding-right: 10px; padding-left: 10px; padding-bottom: 10px;">
                                            <div style="line-height:10px;font-size:1px">&#160;</div>
                                            <div style="display: table; max-width:151px;">
                                                <!--[if (mso)|(IE)]><table width="131" cellpadding="0" cellspacing="0" border="0"><tr><td style="border-collapse:collapse; padding-right: 10px; padding-left: 10px; padding-bottom: 10px;"  align="center"><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; mso-table-lspace: 0pt;mso-table-rspace: 0pt; width:131px;"><tr><td width="32" style="width:32px; padding-right: 5px;" valign="top"><![endif]-->
                                                <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;Margin-right: 5px">
                                                    <tbody><tr style="vertical-align: top"><td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                            <a href="https://www.facebook.com/" title="Facebook" target="_blank">
                                                                <img src="images/emails/verify/facebook.png" alt="Facebook" title="Facebook" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                                                            </a>
                                                            <div style="line-height:5px;font-size:1px">&#160;</div>
                                                        </td></tr>
                                                    </tbody></table>
                                                <!--[if (mso)|(IE)]></td><td width="32" style="width:32px; padding-right: 5px;" valign="top"><![endif]-->
                                                <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;Margin-right: 5px">
                                                    <tbody><tr style="vertical-align: top"><td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                            <a href="http://twitter.com/" title="Twitter" target="_blank">
                                                                <img src="images/emails/verify/twitter.png" alt="Twitter" title="Twitter" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                                                            </a>
                                                            <div style="line-height:5px;font-size:1px">&#160;</div>
                                                        </td></tr>
                                                    </tbody></table>
                                                <!--[if (mso)|(IE)]></td><td width="32" style="width:32px; padding-right: 0;" valign="top"><![endif]-->
                                                <table align="left" border="0" cellspacing="0" cellpadding="0" width="32" height="32" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;Margin-right: 0">
                                                    <tbody><tr style="vertical-align: top"><td align="left" valign="middle" style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                            <a href="http://plus.google.com/" title="Google+" target="_blank">
                                                                <img src="images/emails/verify/googleplus.png" alt="Google+" title="Google+" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                                                            </a>
                                                            <div style="line-height:5px;font-size:1px">&#160;</div>
                                                        </td></tr>
                                                    </tbody></table>
                                                <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                                            </div>
                                        </div>

                                        <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                                </div>
                            </div>
                            <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                        </div>
                    </div>
                </div>   <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
            </td>
        </tr>
        </tbody>
    </table>
    <!--[if (mso)|(IE)]></div><![endif]-->


    </body></html>
@endsection
