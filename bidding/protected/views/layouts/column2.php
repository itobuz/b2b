<?php $this->beginContent('//layouts/main');

?>
<div id="sidebar">
    <h2>User Menu</h2>
    <dl class="accordion">
      <dt><a href="">Dashboard</a></dt>
      <dd> <a href="#">Account Details</a> </dd>
      <dt><a href="">Your Commodities</a></dt>
      <dd> <a href="#">Post buy / sell requirements</a> <a href="#">View live commodities</a> </dd>
      <dt><a href="">Your Commodity Bids</a></dt>
      <dd> <a href="#">My Recieved Bids</a> <a href="#">My Posted Bids</a> <a href="#">Open Trades</a> <a href="#">Closed Trades</a></dd>
      <dt><a href="">Account Settings</a></dt>
      <dd> <a href="#">Account Details</a></dd>
    </dl>
  </div>
<div id="main_content">
	<?php echo $content; ?>
</div>
<?php $this->endContent(); ?>