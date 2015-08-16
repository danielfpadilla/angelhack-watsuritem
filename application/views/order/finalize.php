<div class="row">
    <div class="col offset-m2 m8">
        <div class="card">
            <form action="<?php echo site_url("order/complete"); ?>" method="post">
                <input type="hidden" name="order[id]" value="<?php echo $order->id; ?>" />
            
                <div class="card-content">
                    <div class="row">
                        <div class="col offset-m1 m10">
                            <h4><?php echo $order->title; ?></h4>
                            <table>
                                <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                        $key = 0;
                        foreach($order->items AS $item)
                        { ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="order[items][<?php echo $key; ?>][status]" id="<?php echo $key; ?>" value="1" />
                                    <label for="<?php echo $key; ?>"></label>
                                </td>
                                <td>
                                    <?php echo $item->description; ?>
                                </td>
                                <td>
                                    <?php echo $item->quantity; ?>
                                </td>
                            </tr>
                    <?php
                            $key++;
                        } ?>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col offset-m1 m10">
                            <button class="btn waves-effect waves-light btn-lg" type="submit" value="complete" name="action">Submit</button>
                            <a class="btn waves-effect btn-lg" href="<?php echo site_url("/dashboard"); ?>">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>