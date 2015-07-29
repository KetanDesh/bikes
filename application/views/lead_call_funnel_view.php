<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="container"  id="container" style="margin-top:62px;">
    <div class="row">
        <div class="col-sm-12" style="padding-top:30px;">
            <?php echo validation_errors('<div class="error col-md-5 col-md-offset-4" style="padding-top:20px;">', '</div>'); ?>
            <?php echo form_open_multipart('Lead_call_funnel/download','class="form-horizontal col-sm-offset-5"');?>
                <div class="form-group">
                    <div class="col-sm-2">
                      <?php  
                            echo form_label('Start Date:');
                                $date = array(
                                'type' => 'text',
                                'id' => 'start_date',
                                'name' => 'start_date',
                                'class' => 'input_box',
                                'placeholder' => 'dd/mm/yyyy',
                                'required' => ''
                                );
                            echo form_input($date);
                            echo form_label('End Date:');
                                $date = array(
                                'type' => 'text',
                                'id' => 'end_date',
                                'name' => 'end_date',
                                'class' => 'input_box',
                                'placeholder' => 'dd/mm/yyyy',
                                'required' => ''
                                );
                            echo form_input($date);
                            ?>
                        </br>
                            <select name="type" id="type" style="margin-top:20px;">
                                <option>Select Type</option>
                                <!--option value="Lead_funnel">Lead funnel</option-->
                            </select>
                            <div class="form-group" style="margin-top:20px;">
                            <div class="col-sm-offset-2 col-sm-10"> <button type="submit" id="submit" class="btn btn-primary btn-sm">Download</button> </div> 
                        </div>
                    </div> 
                </div> 
            <?php echo form_close(); ?>
        </div>
    </div>
</div>