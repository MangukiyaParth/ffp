<?php
class Subscription extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('is_admin_login') != true) {
            redirect(ADMIN_URL . 'login');
            exit;
        }
        if ($this->session->userdata('role') != 0) {
            redirect(ADMIN_URL . 'dashboard');
        }
        $this->load->model('admin/mdl_pyments');
        $this->load->helper('array_group_by');
        $this->load->helper('common');
    }

    public function dayWiseSubscription()
    {
        $data['data'] = array('list' => array());
        $data['middle'] = 'admin/reports/dayWiseSubscription';
        $this->load->view('admin/template', $data);
    }

    public function monthWiseSubscription()
    {
        $response = array();
        $queryData = $this->mdl_pyments->getMonthWiseReportData();
        $groupedData = array_group_by($queryData, 'fortmate_date');
       /*  print_r($groupedData);exit; */
        foreach ($groupedData as $key => $gData) {

            $loopArray = array(
                'date' => $key,
                'monthly_total' => 0,
                'monthly_3_total' => 0,
                'monthly_6_total' => 0,
                'yearly_total' => 0,
                'total_exclusive' => 0,
                'trail_total' => 0,
                'total_refund' => 0,
            );

            $totalPaid = 0;
            $totalAmount = 0;
            $totalRefundAmount = 0;
            foreach ($gData as $lData) {
                $typeKey = 'trail_total';
                if ($lData->packageid == 2) {
                    $typeKey = 'monthly_total';
                } elseif ($lData->packageid == 4) {
                    $typeKey = 'yearly_total';
                }  elseif ($lData->packageid == 3) {
                    $typeKey = 'monthly_3_total';
                }  elseif ($lData->packageid == 5) {
                    $typeKey = 'monthly_6_total';
                }  elseif ($lData->packageid == 6) {
                    $typeKey = 'total_exclusive';
                } elseif ($lData->pstatus == 'Refund') {
                    $typeKey = 'total_refund';
                    $totalRefundAmount += $lData->pprice;
                }
                /* if ($lData->pstatus == '1 Month Plan') {
                    $typeKey = 'monthly_total';
                } elseif ($lData->pstatus == '12 Month Plan') {
                    $typeKey = 'yearly_total';
                }  elseif ($lData->pstatus == '3 Month Plan') {
                    $typeKey = 'monthly_3_total';
                }  elseif ($lData->pstatus == '6 Month Plan') {
                    $typeKey = 'monthly_6_total';
                } elseif ($lData->pstatus == 'Refund') {
                    $typeKey = 'total_refund';
                    $totalRefundAmount += $lData->pprice;
                } */

                $loopArray[$typeKey] = $lData->total;

                if (!in_array($typeKey, ['trail_total', 'total_refund'])){
                    $totalPaid += $lData->total;
                    $totalAmount += $lData->total_amount;
                }
            }

            $loopArray['total_paid'] = $totalPaid;
            $loopArray['total_amount'] = $totalAmount;
            $loopArray['total_refund_amount'] = $totalRefundAmount;

            $response[] = $loopArray;
        }

        $data['data'] = array(
            'list' => $response
        );
        $data['middle'] = 'admin/reports/monthWiseSubscription';
        $this->load->view('admin/template', $data);
    }

    function getDayWiseReport()
    {
        $data = array();
        $queryData = $this->mdl_pyments->getDayWiseReportData($_POST);
        $i = $_POST['start'];

        $groupedData = array_group_by($queryData, 'pdate');

        $resMonthlyTotal = 0;
        $resYearlyTotal = 0;
        $exclusiveTotal = 0;
        $res3MonthTotal = 0;
        $res6MonthTotal = 0;
        $resTrailTotal = 0;
        $resTotalPaid = 0;
        $resTotalAmount = 0;
        $totalRefund = 0;
        $totalRefundAmount = 0;

        foreach ($groupedData as $key => $gData) {
            $i++;

            $loopArray = array(
                'monthly_total' => 0,
                'monthly_3_total' => 0,
                'monthly_6_total' => 0,
                'yearly_total' => 0,
                'exclusive_total' => 0,
                'trail_total' => 0,
                'totalRefund' => 0,
                'totalRefundAmount' => 0
            );

            $totalPaid = 0;
            $totalAmount = 0;
            $totalDayRefundAmount = 0;
            $totalDayRefund = 0;
            foreach ($gData as $lData) {

                $typeKey = 'trail_total';
                if ($lData->packageid == '2' && $lData->pstatus != 'Refund') {
                    $typeKey = 'monthly_total';
                    $resMonthlyTotal += $lData->total;
                } elseif ($lData->packageid == '4' && $lData->pstatus != 'Refund') {
                    $typeKey = 'yearly_total';
                    $resYearlyTotal += $lData->total;
                } elseif ($lData->packageid == '6' && $lData->pstatus != 'Refund') {
                    $typeKey = 'exclusive_total';
                    $exclusiveTotal += $lData->total;
                } elseif ($lData->packageid == '3' && $lData->pstatus != 'Refund') {
                    $typeKey = 'monthly_3_total';
                    $res3MonthTotal += $lData->total;
                } elseif ($lData->packageid == '5' && $lData->pstatus != 'Refund') {
                    $typeKey = 'monthly_6_total';
                    $res6MonthTotal += $lData->total;
                } elseif ($lData->pstatus == 'Refund') {
                    $typeKey = 'totalRefund';
                    $totalDayRefundAmount += $lData->pprice;
                    $totalDayRefund += $lData->total;
                } else {
                    $resTrailTotal += $lData->total;
                }

                $loopArray[$typeKey] = $lData->total;

                if (!in_array($typeKey, ['trail_total', 'totalRefund'])){
                    $totalPaid += $lData->total;
                    $totalAmount += $lData->total_amount;
                }
            }

            $loopArray['total_paid'] = $totalPaid ;
            $loopArray['total_amount'] = $totalAmount - $totalDayRefundAmount;

            $totalRefundAmount +=$totalDayRefundAmount;
            $totalRefund +=  $loopArray['totalRefund'];

            $resTotalPaid += $totalPaid;
            $resTotalAmount += $totalAmount;
            
            $lTotalAmount = IND_money_format($loopArray["total_amount"]);

            $data[] = array(
                'DT_RowId' => $key,
                $i,
                $key,
                $loopArray['monthly_total'],
                $loopArray['monthly_3_total'],
                $loopArray['monthly_6_total'],
                $loopArray['yearly_total'],
                $loopArray['exclusive_total'],
                $loopArray['trail_total'],
                $loopArray['totalRefund'],
                "₹ $totalDayRefundAmount",
                $loopArray['total_paid'],
                "₹ $lTotalAmount",
            );

        }

        $resTotalAmount = $resTotalAmount - $totalRefundAmount;
        $resTotalAmount = IND_money_format($resTotalAmount);
        /* $finalPaidTotal = $resTotalPaid - $totalRefund; */

        $data[] = array(
            'DT_RowId' => 'total',
            '',
            '<strong>Total</strong>',
            "<strong>$resMonthlyTotal</strong>",
            "<strong>$res3MonthTotal</strong>",
            "<strong>$res6MonthTotal</strong>",
            "<strong>$resYearlyTotal</strong>",
            "<strong>$exclusiveTotal</strong>",
            "<strong>$resTrailTotal</strong>",
            "<strong>$totalRefund</strong>",
            "<strong>₹ $totalRefundAmount</strong>",
            "<strong>$resTotalPaid</strong>",
            "<strong>₹ $resTotalAmount </strong>",
        );

        $countData = count($data);
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $countData,
            "recordsFiltered" => $countData,
            "data" => $data,
        );
        echo json_encode($output);
    }


    public function repeatSubscriptionList()
    {
        $data['data'] = array('list' => array());
        $data['middle'] = 'admin/reports/repeatSubscription';
        $this->load->view('admin/template', $data);
    }
    
    function getRepeatSubscription()
    {
        $data = array();
        $queryData = $this->mdl_pyments->getRepeatList($_POST);
        $i = $_POST['start'];


        foreach ($queryData as $gData) {
            $i++;

            $data[] = array(
                'DT_RowId' => $i,
                'name' => $gData->name,
                'mobile' => $gData->mobile,
                'pstatus' => $gData->pstatus,
                'total' => $gData->total,
                'firstDate' => date('d-m-Y',strtotime($gData->firstDate)),
                'lastDate' => date('d-m-Y',strtotime($gData->lastDate))
            );
        }

        $countData = count($data);
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $countData,
            "recordsFiltered" => $countData,
            "data" => $data,
        );
        echo json_encode($output);
    }

}
