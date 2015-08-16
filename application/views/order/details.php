<div class="row">
    <div class="col offset-m2 m8">
        <div class="card">
            <form action="<?php echo site_url("order/serve"); ?>" method="post">
                <input type="hidden" name="order[id]" value="<?php echo $order->id; ?>" />
                
                <div class="card-content">
                    
                    <div class="row">
                        <div class="col offset-m1 m10">
                            <h4><?php echo $order->title; ?></h4>
                            <h6>Served By: <?php echo $order->assistant->name; ?></h6>
                            <table>
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                <?php
                    $n = 1;
                    foreach($order->items AS $item)
                    { ?>
                        <tr>
                            <td><?php echo $n; ?></td>
                            <td><?php echo $item->description; ?></td>
                            <td><?php echo $item->quantity; ?></td>
                        </tr>
                <?php
                        $n++;
                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col offset-m1 m10">
                            <a class="btn waves-effect btn-lg" href="<?php echo site_url("/dashboard"); ?>">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>