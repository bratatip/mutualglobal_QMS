<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
            content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <style>
            /* @media print {
      body {
        margin: 0;
        padding: 0;
      }

      .no-margin {
        margin: 0 !important;
      }

      .no-padding {
        padding: 0 !important;
      }
      @page: first {
      margin: 0 !important;
    }
    } */



            table,
            th,
            td {
                border: 1px solid #F7B610;
            }

            td {
                font-size: 14px;
                font-family: Arial, sans-serif;
            }

            .page-break {
                page-break-before: always;
            }

            .rotate-text-container {
                display: inline-block;
                white-space: nowrap;
                transform: rotate(270deg);
                max-width: fit-content;
                /* transform-origin: 0 0; */
            }

            /* #rotate-text {
      transform: rotate(270deg);
      white-space: nowrap;
    }

    .rotate-cell {
      width: 40px;
    } */
        </style>
    </head>

    <body>
        <div>
            <!-- Side Template Image And Top Brand Logo -->
            <img src="{{ asset('images/pdf/logo.png') }}"
                alt="..."
                style="width: 60%; position: absolute; top: -20px; left: 75%; transform: translateX(-50%); z-index: 2;">
            <img src="{{ asset('images/pdf/yellow1.png') }}"
                alt="..."
                style="width: 55%; height: 80%;  position: absolute; top: 10%; left: -50px; z-index: 1;">


            <!-- Top Right  Text -->
            <div style="text-align: right; margin-top: 13%; margin-right: -30px; font-size: 24px;">
                <strong>
                    You have mastered Success.<br>
                    <span style="border-bottom: 2px solid #F7B902;">
                        With us master the risk Complexities that comes with it
                    </span><br>
                    Your customized quote for
                </strong>
            </div>

            <!-- Center Text  -->
            <div style="text-align: center; margin-top: 25%;  font-size:24px; ">
                <strong>
                    <span style="border-bottom: 2px solid #F7B902;">
                        Our Services
                    </span><br>
                </strong>
            </div>
            <div style="text-align: center; margin-top:15px; margin-left: 2rem;font-size:20px; ">
                <strong>Risk Analysis </strong>

            </div>
            <div style="text-align: center; margin-top:15px; margin-left: 8rem; font-size:20px; ">
                <strong>Claims Management </strong>

            </div>
            <div style="text-align: center; margin-top:15px;  margin-left: 15rem; font-size:20px;">
                <strong>General Insurance Placement</strong>
            </div>


            <!-- Qr Image  -->
            <img src="{{ asset('images/pdf/qr.png') }}"
                alt="..."
                style="width: 60%; position: absolute; margin-top:15rem; left: 70%; transform: translateX(-50%); z-index: 1;">
            <!-- Text inside QR image -->
            <div
                style="width: 60%; position: absolute; margin-top:16rem; left: 73%; transform: translateX(-50%); z-index: 2;">
                visit us at: www.mutualglobal.com<br>
                write to us at :support@mutualglobal.com <br>
                Call us at : 9620960093 <br>

                <div style="display: inline-block;margin-top:5px;">
                    Like us at:
                    <img src="{{ asset('images/pdf/facebook.png') }}"
                        alt="Facebook"
                        width="15"
                        height="15"
                        style="margin-bottom: -3px;">
                    <img src="{{ asset('images/pdf/twitter.png') }}"
                        alt="Twitter"
                        width="15"
                        height="15"
                        style="margin-bottom: -3px;">
                </div><br>

                <div style="display: inline-block; margin-top:5px;">
                    Search us at :
                    <img src="{{ asset('images/pdf/google.png') }}"
                        alt="Google"
                        width="30"
                        height="30"
                        style="margin-bottom: -10px;">
                </div>
                <div style=" margin-top:-25px;  transform: translateX(70%); z-index: 2;">
                    Scan or click <br>
                    to locate us
                </div>

            </div>
            <!-- Text before footer -->

            <div style="text-align: right; margin-top:27rem; margin-right: -30px; font-size: 24px;">
                <strong>
                    Trusted by<br>
                    <span style="color: #F7B902; font-size: 28px; line-height: -10px;">
                        CLIENTS
                    </span><br>
                    For all Insurance needs
                </strong>
            </div>

            <!-- Footer -->
            <div
                style="text-align: center;font-size: 12px; background-color: black; color:white; position: absolute; left: -46px; bottom:-46px; width: 50rem;">
                <strong>Mutual Global Insurance Broking Pvt Ltd, (Licence No : 752, Licence period 01/07/2021 to
                    30/06/2024), 2nd Floor, 16/1, AVS Compound,<br>
                    80ft Road, 4th Block, Koramangala, Bangalore 560034, An ISO Certified Company (ISO 9001:2015
                    Certificate No 22IQKS27)
                </strong>
            </div>



        </div>
        <table class="page-break"
            style="border-collapse: collapse;  width:100%;">
            <tbody>
                <tr>
                    <td style=" white-space: normal;"><strong>Insured Name</strong></td>
                    <td style=" white-space: normal;"><strong>{{ $customer->name }}</strong></td>

                    <td><strong>Mailing Address:</strong></td>
                    <td>{{ $customer->address }}</td>
                </tr>


                <tr>
                    <td><strong>Risk Location</strong></td>
                    <td>{{ $quote->risk_location }}</td>

                    <td><strong>Occupancy:</strong></td>
                    <td style=" white-space: normal;">
                        <!-- {{ $riskOccupancy->risk_occupancy }} -->
                        @php
                            $riskOccupancyText = $riskOccupancy->risk_occupancy;
                            $maxLength = 30; // Set the maximum length before wrapping
                            if (strlen($riskOccupancyText) > $maxLength) {
                                echo wordwrap($riskOccupancyText, $maxLength, "\n", true);
                            } else {
                                echo $riskOccupancyText;
                            }
                        @endphp
                    </td>
                </tr>


                <tr>
                    <td><strong>Risk Code </strong></td>
                    <td>{{ $riskOccupancy->risk_code }}</td>

                    <td><strong>IIB Code</strong></td>
                    <td style=" white-space: normal;">
                        {{ $riskOccupancy->iib_code }}
                    </td>
                </tr>


                <tr>
                    <td><strong>Policy Period</strong></td>
                    <td>12 Months</td>
                    <td><strong>RM</strong></td>
                    <td>{{ $quote->user->name }}</td>
                </tr>

                <tr>
                    <td colspan="4"
                        style="border: 0; height: 20px !important;"></td>
                </tr>
            </tbody>

            <tr>
                <td rowspan="11">
                    <div class="rotate-text-container">
                        <strong>Sum Insured Breakup</strong>
                    </div>
                    <!-- <p id="rotate-text"><strong>Sum Insured Breakup </strong></p> -->
                </td>
                <td>Building Including all development works</td>
                <td colspan="2">{{ $quote->buildings_and_other_structural_work ?? 0 }}</td>
            </tr>

            <tr>
                <td>Plate Glass</td>
                <td colspan="2">{{ $quote->fassade_glasses ?? 0 }}</td>
            </tr>

            <tr>
                <td>Furniture, Fixture and Fittings</td>
                <td colspan="2">{{ $quote->furniture_and_fittings ?? 0 }}</td>
            </tr>

            <tr>
                <td>Plant and Machinery </td>
                <td colspan="2">{{ $quote->plants_and_machines ?? 0 }}</td>
            </tr>

            <tr>
                <td>Electrical Fittings </td>
                <td colspan="2">{{ $quote->electrical_fittings ?? 0 }}</td>
            </tr>

            <tr>
                <td>Stocks in process </td>
                <td colspan="2">{{ $quote->stock_in_process ?? 0 }}</td>
            </tr>

            <tr>
                <td>Finished good </td>
                <td colspan="2">{{ $quote->finished_good ?? 0 }}</td>
            </tr>

            <tr>
                <td>Office Equipment Including Computers and Accessories </td>
                <td colspan="2">{{ $quote->computer_and_all_movables ?? 0 }}</td>
            </tr>

            <tr>
                <td>Loss of Rent </td>
                <td colspan="2">{{ $quote->loss_of_rent ?? 0 }}</td>
            </tr>

            <tr>
                <td>Business interuption </td>
                <td colspan="2">{{ $quote->business_interuption ?? 0 }}</td>
            </tr>



            <tr>
                <td> <strong>Total Sum Insured </strong> </td>
                <td colspan="2"><strong>{{ $quote->total_sum_insured }}</strong></td>
            </tr>

            <tr>
                <td colspan="4"
                    style="border: 0; height: 20px !important;"></td>
            </tr>
            <!-- ========================================================================================================== -->

            <tr>
                <td rowspan="13">
                    <div class="rotate-text-container">
                        <strong>Sum Insured Breakup</strong>
                    </div>
                    <!-- <p id="rotate-text"><strong>Coverages with Sum Insured</strong></p> -->
                </td>
                <td>Standard Fire and Special Perils</td>
                <td colspan="2">{{ $quote->total_sum_insured }}</td>
            </tr>

            <tr>
                <td>Storm Tempest Flood and Innundation</td>
                <td colspan="2">{{ $quote->total_sum_insured }}</td>
            </tr>

            <tr>
                <td>Earth Quake</td>
                <td colspan="2">{{ $quote->total_sum_insured }}</td>
            </tr>

            <tr>
                <td>Terrorim</td>
                <td colspan="2">
                    <!-- {{ $quote->terrorism == 1 ? number_format($quote->total_sum_insured, 2) : 0 }} -->
                    {{ $quote->terrorism == 1 ? $quote->total_sum_insured : 0 }}

                </td>
            </tr>

            <tr>
                <td>Machinery Breakdown</td>
                <td colspan="2">{{ $quote->mbd }}</td>
            </tr>


            @php
                $value = floatval($quote->total_sum_insured) - floatval($quote->buildings_and_other_structural_work);
            @endphp

            <tr>
                <td>Burglary including theft @ 25% first loss</td>
                <td colspan="2">{{ $quote->burglary ? $quote->burglary : 0 }}</td>
            </tr>

            <tr>
                <td>Fassade Glasses/Partition Glasses/ Escalator Glasses</td>
                <td colspan="2">{{ $quote->pgi }}</td>
            </tr>

            <tr>
                <td>Cash in safe</td>
                <td colspan="2">{{ $quote->cash_in_safe }}</td>
            </tr>

            <tr>
                <td>Cash in transit</td>
                <td colspan="2">{{ $quote->cash_in_transit }}</td>
            </tr>

            <tr>
                <td>Cash in counter</td>
                <td colspan="2">{{ $quote->cash_in_counter }}</td>
            </tr>

            <tr>
                <td>Loss of rent</td>
                <td colspan="2">{{ $quote->loss_of_rent }}</td>
            </tr>

            <tr>
                <td>Business interption</td>
                <td colspan="2">{{ $quote->business_interuption }}</td>
            </tr>

            <tr>
                <td>All Risk</td>
                <td colspan="2"></td>
            </tr>

            <tr>
                <td colspan="4"
                    style="border: 0; height: 20px !important;"></td>
            </tr>

            <!-- Insurer Section Start-->
            <tr>
                <td style="width: 5px;"><strong>Insurer</strong></td>
                <td><strong>Net Premium</strong></td>

                <td><strong>GST (18%)</strong></td>
                <td><strong>Total</strong></td>
            </tr>
            @foreach ($finalizedInsurers as $insurer)
                <tr>
                    <td style="font-size: 12px;">{{ $insurer->insurer->name }}</td>
                    <td>{{ $insurer->net_premium }}</td>

                    <td>{{ $insurer->net_premium * ($insurer->gst / 100) }}</td>
                    <td>{{ $insurer->net_premium + $insurer->net_premium * ($insurer->gst / 100) }}</td>
                </tr>
            @endforeach


            <tr>
                <td colspan="4"
                    style="border: 0; height: 20px !important;"></td>
            </tr>

            <!-- Insurer Section End-->


            <tr>
                <th colspan="4"
                    style=" background: #F7B610; color: white; text-align: left;">
                    <strong>Standard Fire & Special Perils Policy Conditions</strong>
                </th>
            </tr>
            <tr>
                <td colspan="4"><strong>Excess:</strong></td>
            </tr>
            @foreach ($productConditionsStandardFire as $condition)
                @if ($condition != 'Terrorism cover excluded from the scope of cover')
                    <tr>
                        <td colspan="4">{{ $condition }}</td>
                    </tr>
                @endif
            @endforeach

            @if ($quote->terrorism)
                <tr>
                    <td colspan="4">Terrorism cover included in the scope of cover</td>
                </tr>
            @else
                <tr>
                    <td colspan="4">Terrorism cover excluded from the scope of cover</td>
                </tr>
            @endif


            <tr>
                <td colspan="4"><strong>Clauses:</strong></td>
            </tr>
            @foreach ($productConditionsStandardFireClauses as $condition)
                @if ($condition != 'Terrorism cover excluded from the scope of cover')
                    <tr>
                        <td colspan="4">{{ $condition }}</td>
                    </tr>
                @endif
            @endforeach


            <tr>
                <td colspan="4"><strong>Conditions/Warranties:</strong></td>
            </tr>
            @foreach ($productConditionsStandardFireConditionsWarranties as $condition)
                @if ($condition != 'Terrorism cover excluded from the scope of cover')
                    <tr>
                        <td colspan="4">{{ $condition }}</td>
                    </tr>
                @endif
            @endforeach

            <tr>
                <td colspan="4"
                    style="border: 0; height: 20px !important;"></td>
            </tr>

            <!-- Burglary  -->
            @if ($quote->burglary)

                <tr>
                    <th colspan="4"
                        style="background: #F7B610 ; color: white; text-align: left;">
                        <strong>Burglary Coverage terms and Conditions</strong>
                    </th>
                </tr>
                <tr>
                    <td colspan="4"><strong>Excess:</strong></td>
                </tr>
                @foreach ($productConditionsBurglary as $condition)
                    <tr>
                        <td colspan="4">{{ $condition }}</td>
                    </tr>
                @endforeach
            @endif

            <tr>
                <td colspan="4"
                    style="border: 0; height: 20px !important;"></td>
            </tr>

            <!-- glasses -->
            @if ($quote->pgi != '0.00')

                <tr>
                    <th colspan="4"
                        style=" background: #F7B610; color: white; text-align: left;">
                        <strong>Plate Glass Insurance Terms and Conditions</strong>
                    </th>
                </tr>
                <tr>
                    <td colspan="4"><strong>Excess:</strong></td>
                </tr>
                @foreach ($productConditionsGlasses as $condition)
                    <tr>
                        <td colspan="4">{{ $condition }}</td>
                    </tr>
                @endforeach
            @endif

            <tr>
                <td colspan="4"
                    style="border: 0; height: 20px !important;"></td>
            </tr>
            <!-- machines -->

            @if ($quote->mbd != '0.00')
                <tr>
                    <th colspan="4"
                        style=" background: #F7B610; color: white;text-align: left;">
                        <strong>Machinery Breakdown Terms and Conditions</strong>
                    </th>
                </tr>
                <tr>
                    <td colspan="4"><strong>Excess:</strong></td>
                </tr>
                @foreach ($productConditionsMachinery as $condition)
                    <tr>
                        <td colspan="4">{{ $condition }}</td>
                    </tr>
                @endforeach
            @endif
            <tr>
                <th colspan="4"
                    style=" background: #F7B610; color: white;text-align: center;"><strong>End of The Quote; Quote
                        released by {{ auth()->user()->name }} </strong></th>
            </tr>
            </tbody>

            <!--  -->


        </table>

    </body>

</html>
