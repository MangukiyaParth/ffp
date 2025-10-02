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

        $p1_total = 0;
        $p2_total = 0;
        $p3_total = 0;
        $p4_total = 0;
        $p5_total = 0;
        $p6_total = 0;
        $p7_total = 0;
        $p8_total = 0;
        $resTrailTotal = 0;
        $resTotalPaid = 0;
        $resTotalAmount = 0;
        $totalRefund = 0;
        $totalRefundAmount = 0;

        foreach ($groupedData as $key => $gData) {
            $i++;

            $loopArray = array(
                'p1_total' => 0,
                'p2_total' => 0,
                'p3_total' => 0,
                'p4_total' => 0,
                'p5_total' => 0,
                'p6_total' => 0,
                'p7_total' => 0,
                'p8_total' => 0,
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
                if ($lData->packageid == '1' && $lData->pstatus != 'Refund') {
                    $typeKey = 'p1_total';
                    $p1_total += $lData->total;
                } elseif ($lData->packageid == '2' && $lData->pstatus != 'Refund') {
                    $typeKey = 'p2_total';
                    $p2_total += $lData->total;
                } elseif ($lData->packageid == '3' && $lData->pstatus != 'Refund') {
                    $typeKey = 'p3_total';
                    $p3_total += $lData->total;
                } elseif ($lData->packageid == '4' && $lData->pstatus != 'Refund') {
                    $typeKey = 'p4_total';
                    $p4_total += $lData->total;
                } elseif ($lData->packageid == '5' && $lData->pstatus != 'Refund') {
                    $typeKey = 'p5_total';
                    $p5_total += $lData->total;
                } elseif ($lData->packageid == '6' && $lData->pstatus != 'Refund') {
                    $typeKey = 'p6_total';
                    $p6_total += $lData->total;
                } elseif ($lData->packageid == '7' && $lData->pstatus != 'Refund') {
                    $typeKey = 'p7_total';
                    $p7_total += $lData->total;
                } elseif ($lData->packageid == '8' && $lData->pstatus != 'Refund') {
                    $typeKey = 'p8_total';
                    $p8_total += $lData->total;
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
                $loopArray['p1_total'],
                $loopArray['p2_total'],
                $loopArray['p3_total'],
                $loopArray['p4_total'],
                $loopArray['p5_total'],
                $loopArray['p6_total'],
                $loopArray['p7_total'],
                $loopArray['p8_total'],
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
            "<strong>$p1_total</strong>",
            "<strong>$p2_total</strong>",
            "<strong>$p3_total</strong>",
            "<strong>$p4_total</strong>",
            "<strong>$p5_total</strong>",
            "<strong>$p6_total</strong>",
            "<strong>$p7_total</strong>",
            "<strong>$p8_total</strong>",
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
