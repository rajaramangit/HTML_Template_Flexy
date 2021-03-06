--TEST--
Template Test: forms.html
--FILE--
<?php
require_once 'testsuite.php';
require_once 'HTML/Template/Flexy/Factory.php';

$elements = HTML_Template_Flexy_Factory::fromArray(array(
    'test123' => 'hello',
    'test12a' => 'hello',
    'test12ab' => 'hello',
    'fred' => 'hello',
    'aaa1' => 'hello',
    'List' => '2000',
    'testingxhtml' => 'checked',
    
));

$elements["testingcheckbox"] = new HTML_Template_Flexy_Element;
$elements["testingcheckbox"]->setValue(123);


#bug6058
$elements['payment_1_type'] = new HTML_Template_Flexy_Element;
$elements['payment_1_type']->attributes['flexy:xhtml'] = true;
$elements['payment_1_type']->setValue('cq');

// this exhibits unusual behavior, but is not really a bug
// actually the correct usage is to use '' where 'input' is.
$elements['payment_2_type'] = new HTML_Template_Flexy_Element('input',
				array('flexy:xhtml' => true));
$elements['payment_2_type']->setValue('cq');




compilefile('forms.html',
    array(),
    array(
        'show_elements' => true
    ),
    $elements
);

--EXPECTF--
===Compiling forms.html===



===Compiled file: forms.html===

<h2>Form Not Parsed</h2>

<form name="test">
    <input name=test123>
    <select name="aaa">
        <option>bb</option>
    </select>
</form>

<h2>Parsed</h2>


<?php echo $this->elements['test']->toHtmlnoClose();?>
    Input<?php echo $this->elements['test123']->toHtml();?>
    Checkbox <?php echo $this->elements['test123a']->toHtml();?>
    Hidden <?php echo $this->elements['test123ab']->toHtml();?>
    <?php echo $this->elements['fred']->toHtml();?>
    <?php echo $this->elements['aaa1']->toHtml();?>
    <select name="aaa2">
        <option>aa</option>
	<option selected>bb</option>
        <option>cc</option>

    </select>
    <?php echo $this->elements['aaa3']->toHtml();?>
    
    <!-- bug 5267 -->
    <?php 
                    $_element = $this->elements['opt_1'];
                    if (isset($this->elements['opt[]'])) {
                        $_element = $this->mergeElement($_element,$this->elements['opt[]']);
                    }
                    echo  $_element->toHtml();?>
    <label for="opt_1">option 1</label>
    <?php 
                    $_element = $this->elements['opt_2'];
                    if (isset($this->elements['opt[]'])) {
                        $_element = $this->mergeElement($_element,$this->elements['opt[]']);
                    }
                    echo  $_element->toHtml();?>
    <label for="opt_3">option 2</label>
    <?php 
                    $_element = $this->elements['opt_3'];
                    if (isset($this->elements['opt[]'])) {
                        $_element = $this->mergeElement($_element,$this->elements['opt[]']);
                    }
                    echo  $_element->toHtml();?>
    <label for="opt_3">option 3</label>



    
    <?php echo $this->elements['List']->toHtml();?>
    <?php echo $this->elements['_submit[4]']->toHtml();?>
    <?php echo $this->elements['_submit[5]']->toHtml();?>
    
    <?php echo $this->elements['testupload']->toHtml();?>
    
    #bug  bug6058    

    <br /><?php 
                    $_element = $this->elements['1'];
                    if (isset($this->elements['payment_1_type'])) {
                        $_element = $this->mergeElement($_element,$this->elements['payment_1_type']);
                    }
                    echo  $_element->toHtml();?>
        Credit card
    <br /><?php 
                    $_element = $this->elements['2'];
                    if (isset($this->elements['payment_1_type'])) {
                        $_element = $this->mergeElement($_element,$this->elements['payment_1_type']);
                    }
                    echo  $_element->toHtml();?>
        Cheque

    <br /><?php 
                    $_element = $this->elements['3'];
                    if (isset($this->elements['payment_2_type'])) {
                        $_element = $this->mergeElement($_element,$this->elements['payment_2_type']);
                    }
                    echo  $_element->toHtml();?>
        Credit card
    <br /><?php 
                    $_element = $this->elements['4'];
                    if (isset($this->elements['payment_2_type'])) {
                        $_element = $this->mergeElement($_element,$this->elements['payment_2_type']);
                    }
                    echo  $_element->toHtml();?>
        Cheque
    
    
    
    
</form>

<?php echo $this->elements['picture']->toHtml();?>

<h2>Bug 1120:</h2>
<form action="test">
<?php echo $this->elements['testing']->toHtml();?>
<?php echo $this->elements['_submit[2]']->toHtml();?>
</form>

<form action="<?php echo htmlspecialchars($t->someurl);?>">
<?php 
if (!isset($this->elements['testing2']->attributes['value'])) {
    $this->elements['testing2']->attributes['value'] = '';
    $this->elements['testing2']->attributes['value'] .=  htmlspecialchars($t->somevalue);
}
$_attributes_used = array('value');
echo $this->elements['testing2']->toHtml();
if (isset($_attributes_used)) {  foreach($_attributes_used as $_a) {
    unset($this->elements['testing2']->attributes[$_a]);
}}
?>
<?php echo $this->elements['_submit[1]']->toHtml();?>
</form>

<H2> Bug 1275 XHTML output </H2>
<?php echo $this->elements['testingxhtml']->toHtml();?>
<?php echo $this->elements['xhtmllisttest']->toHtml();?>


<H2> Bug 4005 Checkboxes </H2>
<?php echo $this->elements['testingcheckbox']->toHtml();?>







<?php 
if (!isset($this->elements['test_mix']->attributes['action'])) {
    $this->elements['test_mix']->attributes['action'] = '';
    $this->elements['test_mix']->attributes['action'] .=  htmlspecialchars($t->someurl);
}
$_attributes_used = array('action');
echo $this->elements['test_mix']->toHtmlnoClose();
if (isset($_attributes_used)) {  foreach($_attributes_used as $_a) {
    unset($this->elements['test_mix']->attributes[$_a]);
}}
?>
<?php 
if (!isset($this->elements['testing5']->attributes['value'])) {
    $this->elements['testing5']->attributes['value'] = '';
    $this->elements['testing5']->attributes['value'] .=  htmlspecialchars($t->somevalue);
}
$_attributes_used = array('value');
echo $this->elements['testing5']->toHtml();
if (isset($_attributes_used)) {  foreach($_attributes_used as $_a) {
    unset($this->elements['testing5']->attributes[$_a]);
}}
?>
<?php echo $this->elements['_submit[3]']->toHtml();?>
</form>
Array
(
    [test] => HTML_Template_Flexy_Element Object
        (
            [tag] => form
            [attributes] => Array
                (
                    [name] => test
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [test123] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [name] => test123
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [test123a] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [name] => test123a
                    [id] => test123ab
                    [type] => checkbox
                    [checked] => 1
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [test123ab] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [name] => test123ab
                    [type] => hidden
                    [value] => 123
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [fred] => HTML_Template_Flexy_Element Object
        (
            [tag] => textarea
            [attributes] => Array
                (
                    [name] => fred
                )

            [children] => Array
                (
                    [0] => some text
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [aaa1] => HTML_Template_Flexy_Element Object
        (
            [tag] => select
            [attributes] => Array
                (
                    [name] => aaa1
                )

            [children] => Array
                (
                    [0] => 
        
                    [1] => HTML_Template_Flexy_Element Object
                        (
                            [tag] => option
                            [attributes] => Array
                                (
                                )

                            [children] => Array
                                (
                                    [0] => aa
                                )

                            [override] => 
                            [prefix] => 
                            [suffix] => 
                            [value] => 
                            [label] => 
                        )

                    [2] => 
	
                    [3] => HTML_Template_Flexy_Element Object
                        (
                            [tag] => option
                            [attributes] => Array
                                (
                                    [selected] => 1
                                )

                            [children] => Array
                                (
                                    [0] => bb
                                )

                            [override] => 
                            [prefix] => 
                            [suffix] => 
                            [value] => 
                            [label] => 
                        )

                    [4] => 
        
                    [5] => HTML_Template_Flexy_Element Object
                        (
                            [tag] => option
                            [attributes] => Array
                                (
                                )

                            [children] => Array
                                (
                                    [0] => cc
                                )

                            [override] => 
                            [prefix] => 
                            [suffix] => 
                            [value] => 
                            [label] => 
                        )

                    [6] => 
    
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [aaa3] => HTML_Template_Flexy_Element Object
        (
            [tag] => select
            [attributes] => Array
                (
                    [name] => aaa3
                )

            [children] => Array
                (
                    [0] => 
        
                    [1] => HTML_Template_Flexy_Element Object
                        (
                            [tag] => option
                            [attributes] => Array
                                (
                                )

                            [children] => Array
                                (
                                    [0] => aa
                                )

                            [override] => 
                            [prefix] => 
                            [suffix] => 
                            [value] => 
                            [label] => 
                        )

                    [2] => 
	
                    [3] => HTML_Template_Flexy_Element Object
                        (
                            [tag] => option
                            [attributes] => Array
                                (
                                    [selected] => 1
                                )

                            [children] => Array
                                (
                                    [0] => bb
                                )

                            [override] => 
                            [prefix] => 
                            [suffix] => 
                            [value] => 
                            [label] => 
                        )

                    [4] => 
        
                    [5] => HTML_Template_Flexy_Element Object
                        (
                            [tag] => option
                            [attributes] => Array
                                (
                                )

                            [children] => Array
                                (
                                    [0] => cc
                                )

                            [override] => 
                            [prefix] => 
                            [suffix] => 
                            [value] => 
                            [label] => 
                        )

                    [6] => 

    
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [opt_1] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [id] => opt_1
                    [type] => checkbox
                    [name] => opt[]
                    [value] => 1
                    [/] => 1
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [opt_2] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [id] => opt_2
                    [type] => checkbox
                    [name] => opt[]
                    [value] => 2
                    [/] => 1
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [opt_3] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [id] => opt_3
                    [type] => checkbox
                    [name] => opt[]
                    [value] => 3
                    [/] => 1
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [List] => HTML_Template_Flexy_Element Object
        (
            [tag] => select
            [attributes] => Array
                (
                    [name] => List
                )

            [children] => Array
                (
                    [0] => 
        
                    [1] => HTML_Template_Flexy_Element Object
                        (
                            [tag] => option
                            [attributes] => Array
                                (
                                    [value] => 2000
                                )

                            [children] => Array
                                (
                                    [0] => 2000
                                )

                            [override] => 
                            [prefix] => 
                            [suffix] => 
                            [value] => 
                            [label] => 
                        )

                    [2] => 
        
                    [3] => HTML_Template_Flexy_Element Object
                        (
                            [tag] => option
                            [attributes] => Array
                                (
                                    [value] => 2001
                                )

                            [children] => Array
                                (
                                    [0] => 2001
                                )

                            [override] => 
                            [prefix] => 
                            [suffix] => 
                            [value] => 
                            [label] => 
                        )

                    [4] => 
        
                    [5] => HTML_Template_Flexy_Element Object
                        (
                            [tag] => option
                            [attributes] => Array
                                (
                                    [value] => 2002
                                )

                            [children] => Array
                                (
                                    [0] => 2002
                                )

                            [override] => 
                            [prefix] => 
                            [suffix] => 
                            [value] => 
                            [label] => 
                        )

                    [6] => 
    
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [_submit[4]] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [type] => submit
                    [name] => _submit[4]
                    [value] => Next >>
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [_submit[5]] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [type] => submit
                    [name] => _submit[5]
                    [value] => Next >>
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [testupload] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [type] => file
                    [name] => testupload
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [payment_1_type] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [type] => radio
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [1] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [type] => radio
                    [name] => payment_1_type
                    [id] => 1
                    [value] => cc
                    [/] => 1
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [2] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [type] => radio
                    [name] => payment_1_type
                    [id] => 2
                    [value] => cq
                    [/] => 1
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [payment_2_type] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [type] => radio
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [3] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [type] => radio
                    [name] => payment_2_type
                    [id] => 3
                    [value] => cc
                    [/] => 1
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [4] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [type] => radio
                    [name] => payment_2_type
                    [id] => 4
                    [value] => cq
                    [/] => 1
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [picture] => HTML_Template_Flexy_Element Object
        (
            [tag] => img
            [attributes] => Array
                (
                    [name] => picture
                    [id] => picture
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [testing] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [name] => testing
                    [value] => test
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [_submit[2]] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [type] => submit
                    [value] => x
                    [name] => _submit[2]
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [testing2] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [name] => testing2
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [_submit[1]] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [type] => submit
                    [name] => _submit[1]
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [testingxhtml] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [type] => checkbox
                    [name] => testingxhtml
                    [checked] => 1
                    [flexy:xhtml] => 1
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [xhtmllisttest] => HTML_Template_Flexy_Element Object
        (
            [tag] => select
            [attributes] => Array
                (
                    [name] => xhtmllisttest
                    [flexy:xhtml] => 1
                )

            [children] => Array
                (
                    [0] => 


                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [testingcheckbox] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [type] => checkbox
                    [name] => testingcheckbox
                    [value] => 123
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [test_mix] => HTML_Template_Flexy_Element Object
        (
            [tag] => form
            [attributes] => Array
                (
                    [name] => test_mix
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [testing5] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [name] => testing5
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

    [_submit[3]] => HTML_Template_Flexy_Element Object
        (
            [tag] => input
            [attributes] => Array
                (
                    [type] => submit
                    [name] => _submit[3]
                )

            [children] => Array
                (
                )

            [override] => 
            [prefix] => 
            [suffix] => 
            [value] => 
            [label] => 
        )

)


===With data file: forms.html===

<h2>Form Not Parsed</h2>

<form name="test">
    <input name=test123>
    <select name="aaa">
        <option>bb</option>
    </select>
</form>

<h2>Parsed</h2>


<form name="test">    Input<input name="test123" value="hello">    Checkbox <input name="test123a" id="test123ab" type="checkbox" checked>    Hidden <input name="test123ab" type="hidden" value="123">    <textarea name="fred">hello</textarea>    <select name="aaa1">
        <option>aa</option>
	<option>bb</option>
        <option>cc</option>
    </select>    <select name="aaa2">
        <option>aa</option>
	<option selected>bb</option>
        <option>cc</option>

    </select>
    <select name="aaa3">
        <option>aa</option>
	<option selected>bb</option>
        <option>cc</option>

    </select>    
    <!-- bug 5267 -->
    <input id="opt_1" type="checkbox" name="opt[]" value="1" />    <label for="opt_1">option 1</label>
    <input id="opt_2" type="checkbox" name="opt[]" value="2" />    <label for="opt_3">option 2</label>
    <input id="opt_3" type="checkbox" name="opt[]" value="3" />    <label for="opt_3">option 3</label>



    
    <select name="List">
        <option value="2000" selected>2000</option>
        <option value="2001">2001</option>
        <option value="2002">2002</option>
    </select>    <input type="submit" name="_submit[4]" value="Next &gt;&gt;">    <input type="submit" name="_submit[5]" value="Next &gt;&gt;">    
    <input type="file" name="testupload">    
    #bug  bug6058    

    <br /><input type="radio" name="payment_1_type" id="1" value="cc" />        Credit card
    <br /><input type="radio" name="payment_1_type" id="2" value="cq" checked="checked" />        Cheque

    <br /><input type="radio" name="payment_2_type" id="3" value="cq" checked="checked" />        Credit card
    <br /><input type="radio" name="payment_2_type" id="4" value="cq" checked="checked" />        Cheque
    
    
    
    
</form>

<img name="picture" id="picture">
<h2>Bug 1120:</h2>
<form action="test">
<input name="testing" value="test"><input type="submit" value="x" name="_submit[2]"></form>

<form action="">
<input name="testing2" value=""><input type="submit" name="_submit[1]"></form>

<H2> Bug 1275 XHTML output </H2>
<input type="checkbox" name="testingxhtml" /><select name="xhtmllisttest">

</select>

<H2> Bug 4005 Checkboxes </H2>
<input type="checkbox" name="testingcheckbox" value="123" checked>






<form name="test_mix" action=""><input name="testing5" value=""><input type="submit" name="_submit[3]"></form>
