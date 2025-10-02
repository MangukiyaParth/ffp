<section role="main" class="content-body">
    <header class="page-header">
        <h2>Monthly Subscription Report</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="<?php echo ADMIN_URL . 'dashboard/' ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span class="">Monthly Subscription Report</span></li>
            </ol>

            <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>


    <div class="row">
        <div class="col-xs-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class="panel-title"><a href="javascipt:void(0);"><i class="fa fa-list" aria-hidden="true"></i></a> &nbsp;Monthly Subscription Report
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-none">
                            <thead>
                                <tr>

                                    <th>Month</th>
                                    <th>1 Monthly</th>
                                    <th>3 Monthly</th>
                                    <th>6 Monthly</th>
                                    <th>Yearly</th>
                                    <th>Exclusive</th>
                                    <th>Trail</th>
                                    <th>Total Refund</th>
                                    <th>Total Refund Amount</th>
                                    <th>Total Paid Subscription</th>
                                    <th>Total Amount</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $monthlyTotal = 0;
                                $monthly3Total = 0;
                                $monthly6Total = 0;
                                $yearlyTotal = 0;
                                $exclusiveTotal = 0;
                                $trailTotal = 0;
                                $totalPaid = 0;
                                $totalAmount = 0;
                                $total_refund = 0;
                                $total_refund_amount = 0;
                                
                                
                                foreach ($list as $value) { 
                                    
                                    $monthlyTotal += $value['monthly_total'];
                                    $monthly3Total += $value['monthly_3_total'];
                                    $monthly6Total += $value['monthly_6_total'];
                                    $yearlyTotal += $value['yearly_total'];
                                    $exclusiveTotal += $value['total_exclusive'];
                                    $trailTotal += $value['trail_total'];
                                    $totalPaid += $value['total_paid'];
                                    $totalAmount += $value['total_amount'];
                                    $total_refund += $value['total_refund'];
                                    $total_refund_amount += $value['total_refund_amount'];
                                    
                                    ?>
                                    <tr id="<?php echo $value['date']; ?>">
                                        <td><?php echo $value['date']; ?></td>
                                        <td><?php echo $value['monthly_total']; ?></td>
                                        <td><?php echo $value['monthly_3_total']; ?></td>
                                        <td><?php echo $value['monthly_6_total']; ?></td>
                                        <td><?php echo $value['yearly_total']; ?></td>
                                        <td><?php echo $value['total_exclusive']; ?></td>
                                        <td><?php echo $value['trail_total']; ?></td>
                                        <td><?php echo $value['total_refund']; ?></td>
                                        <td><?php echo $value['total_refund_amount']; ?></td>
                                        <td><?php echo $value['total_paid']; ?></td>
                                        <td>₹ <?php echo IND_money_format($value['total_amount']); ?></td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><strong>Total</strong></td>
                                    <td><strong><?php echo $monthlyTotal; ?></strong></td>
                                    <td><strong><?php echo $monthly3Total; ?></strong></td>
                                    <td><strong><?php echo $monthly6Total; ?></strong></td>
                                    <td><strong><?php echo $yearlyTotal; ?></strong></td>
                                    <td><strong><?php echo $exclusiveTotal; ?></strong></td>
                                    <td><strong><?php echo $trailTotal; ?></strong></td>
                                    <td><strong><?php echo $total_refund; ?></strong></td>
                                    <td><strong><?php echo $total_refund_amount; ?></strong></td>
                                    <td><strong><?php echo $totalPaid; ?></strong></td>
                                    <td><strong>₹ <?php echo IND_money_format($totalAmount); ?></strong></td>
                                    
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>