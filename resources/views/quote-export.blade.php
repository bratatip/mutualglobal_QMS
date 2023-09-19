<table style="border-collapse: collapse; border: 1px solid black;">
    <tbody>
        <tr>
            <td style="border: 1px solid black; white-space: normal;"><strong>Insured Name:</strong></td>
            <td style="border: 1px solid black; white-space: normal;"><strong>{{ $customer->name }}</strong></td>
        </tr>
        <tr>
            <td style="border: 1px solid black;"><strong>Mailing Address:</strong></td>
            <td style="border: 1px solid black;">{{ $customer->address }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid black;"><strong>Risk Location: </strong></td>
            <td style="border: 1px solid black;">{{ $quote->risk_location }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid black;"><strong>Occupancy:</strong></td>
            <td style="border: 1px solid black; white-space: normal;">
                @php
                $riskOccupancyText = $riskOccupancy->riskOccupancy;
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
            <td style="border: 1px solid black;"><strong>Policy Period:</strong></td>
            <td style="border: 1px solid black;">12 Months</td>
            <td style="border: 1px solid black;">Sum Insured</td>
        </tr>
        @if($quote->buildings_and_other_structural_work != "0")
        <tr>
            <td></td>
            <td style="border: 1px solid black;">Building Including all development works</td>
            <td style="border: 1px solid black;">{{ $quote->buildings_and_other_structural_work }}</td>
        </tr>
        @endif

        @if($quote->fassade_glasses != "0")
        <tr>
            <td></td>
            <td style="border: 1px solid black;">Plate Glass</td>
            <td style="border: 1px solid black;">{{ $quote->fassade_glasses }}</td>
        </tr>
        @endif

        @if($quote->furniture_and_fittings != "0")
        <tr>
            <td></td>
            <td style="border: 1px solid black;">Furniture, Fixture and Fittings</td>
            <td style="border: 1px solid black;">{{ $quote->furniture_and_fittings }}</td>
        </tr>
        @endif

        @if($quote->plants_and_machines != "0")
        <tr>
            <td></td>
            <td style="border: 1px solid black;">Plant and Machinery </td>
            <td style="border: 1px solid black;">{{ $quote->plants_and_machines }}</td>
        </tr>
        @endif

        @if($quote->electrical_fittings != "0")
        <tr>
            <td></td>
            <td style="border: 1px solid black;">Electrical Fittings </td>
            <td style="border: 1px solid black;">{{ $quote->electrical_fittings }}</td>
        </tr>
        @endif

        @if($quote->stock_in_process != "0")
        <tr>
            <td></td>
            <td style="border: 1px solid black;">Stocks in process </td>
            <td style="border: 1px solid black;">{{ $quote->stock_in_process }}</td>
        </tr>
        @endif

        @if($quote->finished_good != "0")
        <tr>
            <td></td>
            <td style="border: 1px solid black;">Finished good </td>
            <td style="border: 1px solid black;">{{ $quote->finished_good }}</td>
        </tr>
        @endif

        @if($quote->computer_and_all_movables != "0")
        <tr>
            <td></td>
            <td style="border: 1px solid black;">Office Equipment Including Computers and Accessories </td>
            <td style="border: 1px solid black;">{{ $quote->computer_and_all_movables }}</td>
        </tr>
        @endif

        @if($quote->loss_of_rent != "0")
        <tr>
            <td></td>
            <td style="border: 1px solid black;">Loss of Rent </td>
            <td style="border: 1px solid black;">{{ $quote->loss_of_rent }}</td>
        </tr>
        @endif

        @if($quote->business_interuption != "0")
        <tr>
            <td></td>
            <td style="border: 1px solid black;">Business interuption </td>
            <td style="border: 1px solid black;">{{ $quote->business_interuption }}</td>
        </tr>
        @endif



        <tr>
            <td></td>
            <td style="border: 1px solid black;"> <strong>Total Sum Insured </strong> </td>
            <td style="border: 1px solid black;"><strong>{{ $quote->total_sum_insured }}</strong></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <th style="border: 1px solid black; background: red; color: white;"><strong>SL No: </strong></th>
            <th style="border: 1px solid black; background: red; color: white;"><strong>Coverages </strong></th>
            <th style="border: 1px solid black; background: red; color: white;"><strong>Sum Insured Details </strong></th>
        </tr>


        <tr>
            <th style="border: 1px solid black;"><strong>1</strong></th>
            <th style="border: 1px solid black; ">Standard Fire and Special Perils</th>
            <th style="border: 1px solid black; ">{{ $quote->total_sum_insured }}</th>
        </tr>

        <tr>
            <th style="border: 1px solid black;"><strong>2</strong></th>
            <th style="border: 1px solid black; ">Storm Tempest Flood and Innundation</th>
            <th style="border: 1px solid black; ">{{ $quote->total_sum_insured }}</th>
        </tr>

        <tr>
            <th style="border: 1px solid black;"><strong>3</strong></th>
            <th style="border: 1px solid black; ">Earth Quake</th>
            <th style="border: 1px solid black; ">{{ $quote->total_sum_insured }}</th>
        </tr>

        <tr>
            <th style="border: 1px solid black;"><strong>4</strong></th>
            <th style="border: 1px solid black; ">Terrorim</th>
            <th style="border: 1px solid black; ">
                <!-- {{ $quote->terrorism == 1 ? number_format($quote->total_sum_insured, 2) : 0 }} -->
                {{ $quote->terrorism == 1 ? $quote->total_sum_insured : 0 }}

            </th>
        </tr>

        <tr>
            <th style="border: 1px solid black;"><strong>5</strong></th>
            <th style="border: 1px solid black; ">Machinery Breakdown</th>
            <th style="border: 1px solid black; ">{{$quote->mbd}}</th>
        </tr>


        @php
        $value = floatval($quote->total_sum_insured) - floatval($quote->buildings_and_other_structural_work);
        @endphp

        <tr>
            <th style="border: 1px solid black;"><strong>6</strong></th>
            <th style="border: 1px solid black; ">Burglary including theft @ 25% first loss</th>
            <th style="border: 1px solid black; ">{{ $value }}</th>
        </tr>

        <tr>
            <th style="border: 1px solid black;"><strong>7</strong></th>
            <th style="border: 1px solid black; ">Fassade Glasses/Partition Glasses/ Escalator Glasses</th>
            <th style="border: 1px solid black; ">{{$quote->pgi}}</th>
        </tr>

        <tr>
            <th style="border: 1px solid black;"><strong>8</strong></th>
            <th style="border: 1px solid black; ">Cash in safe</th>
            <th style="border: 1px solid black; "></th>
        </tr>

        <tr>
            <th style="border: 1px solid black;"><strong>9</strong></th>
            <th style="border: 1px solid black; ">Cash in transit</th>
            <th style="border: 1px solid black; "></th>
        </tr>

        <tr>
            <th style="border: 1px solid black;"><strong>10</strong></th>
            <th style="border: 1px solid black; ">Cash in counter</th>
            <th style="border: 1px solid black; "></th>
        </tr>

        <tr>
            <th style="border: 1px solid black;"><strong>11</strong></th>
            <th style="border: 1px solid black; ">Loss of rent</th>
            <th style="border: 1px solid black; ">{{ $quote->loss_of_rent }}</th>
        </tr>

        <tr>
            <th style="border: 1px solid black;"><strong>12</strong></th>
            <th style="border: 1px solid black; ">Business interption</th>
            <th style="border: 1px solid black; ">{{$quote->business_interuption }}</th>
        </tr>

        <tr>
            <th style="border: 1px solid black;"><strong>13</strong></th>
            <th style="border: 1px solid black; ">All Risk</th>
            <th style="border: 1px solid black; "></th>
        </tr>


        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>

        <!-- @php
        $value1 = floatval($quote->total_sum_insured) * 0.36 / 1000;
        $value2 = $value1 * 0.18;
        $sumValue = $value1 + $value2;
        @endphp -->

        <tr>
            <th style="border: 1px solid black;"></th>
            <th style="border: 1px solid black; "><strong>Total</strong></th>
            <th style="border: 1px solid black; "> </th>
        </tr>

        <tr>
            <th style="border: 1px solid black;"></th>
            <th style="border: 1px solid black; ">Service Tax @ 18%</th>
            <th style="border: 1px solid black; "> </th>

        </tr>

        <tr>
            <th style="border: 1px solid black;"></th>
            <th style="border: 1px solid black; "><strong>Premium Payable</strong></th>
            <th style="border: 1px solid black; "><strong></strong></th>
        </tr>

        <!-- Standard Fire  -->

        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>


        <tr>
            <th colspan="3" style="border: 1px solid black; background: red; color: white;"><strong>{{ $productSectionName[3] }}</strong></th>
        </tr>
        <tr>
            <td colspan="3" style="border: 1px solid black;"><strong>Excess:</strong></td>
        </tr>
        @foreach ($productConditionsStandardFire as $condition)
        @if ($condition !== "Terrorism cover excluded from the scope of cover")
        <tr>
            <td colspan="3" style="border: 1px solid black;">{{ $condition }}</td>
        </tr>
        @endif
        @endforeach

        @if ($quote->terrorism == "0")
        <tr>
            <td colspan="3" style="border: 1px solid black;">Terrorism cover excluded from the scope of cover</td>
        </tr>
        @else
        <tr>
            <td colspan="3" style="border: 1px solid black;">Terrorism cover included in the scope of cover</td>
        </tr>

        @endif

        <!-- Buildings  -->
        @if($quote->buildings_and_other_structural_work != "0")

        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>


        <tr>
            <th colspan="3" style="border: 1px solid black; background: red; color: white;"><strong>{{ $productSectionName[0] }}</strong></th>
        </tr>
        <tr>
            <td colspan="3" style="border: 1px solid black;"><strong>Excess:</strong></td>
        </tr>
        @foreach ($productConditionsBurglary as $condition)
        <tr>
            <td colspan="3" style="border: 1px solid black;">{{ $condition }}</td>
        </tr>
        @endforeach
        @endif

        <!-- glasses -->
        @if($quote->pgi != "0")

        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <th colspan="3" style="border: 1px solid black; background: red; color: white;"><strong>{{ $productSectionName[2] }}</strong></th>
        </tr>
        <tr>
            <td colspan="3" style="border: 1px solid black;"><strong>Excess:</strong></td>
        </tr>
        @foreach ($productConditionsGlasses as $condition)
        <tr>
            <td colspan="3" style="border: 1px solid black;">{{ $condition }}</td>
        </tr>
        @endforeach
        @endif


        <!-- machines -->

        @if($quote->mbd != "0")

        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <th colspan="3" style="border: 1px solid black; background: red; color: white;"><strong>{{ $productSectionName[1] }}</strong></th>
        </tr>
        <tr>
            <td colspan="3" style="border: 1px solid black;"><strong>Excess:</strong></td>
        </tr>
        @foreach ($productConditionsMachinery as $condition)
        <tr>
            <td colspan="3" style="border: 1px solid black;">{{ $condition }}</td>
        </tr>
        @endforeach
        @endif
    </tbody>

    <!--  -->


</table>