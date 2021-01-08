
{if $page.meta['title'] != 'Racko e-partners'} 
<div class="row">
    <div class="col-12 custom-shops-title text-center" style='border-bottom: 0 !important'>{l s='RACKO' mod='racko_stores'}</div>

    <div class="col-12 custom-shops-title pb-4 text-center  d-md-none" style="margin: 0 !important; line-height: 1;     border-bottom: 0px solid #eee;">{l s='SHOWROOM' mod='racko_stores'}</div>
        <div class="col-12 custom-shops-title pb-4 text-center  d-md-none" style="margin: 0 !important; line-height: 1;    border-bottom: 0px solid #eee;">{l s='&' mod='racko_stores'}</div>
            <div class="col-12 custom-shops-title pb-4 text-center d-block  d-md-none" style="margin-top: 0 !important; line-height: 1;    border-bottom: 0px solid #eee;">{l s='STORE' mod='racko_stores'}</div>


    <div class="col-12 custom-shops-title pb-4 text-center d-none d-md-block" style="margin-top: 0 !important; line-height: 1">{l s='SHOWROOM & STORE' mod='racko_stores'}</div>
	<div class="col-12 col-md-4 text-center">
		<div class="custom-shop-card">
        	<div class="custom-shops-name">{$show.name}</div>
        	<div class="custom-shops-name">{$show.state} ({$show.name_country})</div>
			<div class="">{$show.address1}</div>
			<div class="">{$show.postcode}, {$show.city}</div>
<div class="custom-shops-email"><a href="tel:{$show.phone}">{$show.phone}</a>{if $show.fax} / <a href="tel:{$show.fax}">{$show.fax}</a>{/if}</div>
			<div class="custom-shops-email"><a  href="mailto:{$show.email}">{$show.email}</a></div>
			<div class="custom-shops-web.note" style="color: balck"><a>{$show.note}</a></div>
    </div>
    

    
    </div>

      <div class="col-12 col-md-4 text-center">
        <img src="{$urls.img_url}/canguro_racko.jpg"  style="max-width: 200px;" />
      </div>
</div>

{/if}




<div class="stores-container">
  <div class="row">
    <div class="col-12 custom-shops-title pb-4 text-center">{l s='España' mod='racko_stores'}</div>
    <div class="col-12 stores-inner d-flex flex-wrap p-0">
      {foreach key=key item=store from=$stores_spain}
      <div class="col-12 col-md-4">
      <div class="custom-shop-card">
	  	{if $page.meta['title'] != 'Racko e-partners'} 
			<div class="custom-shops-name" style="font-weight: normal">{$store.state}{if $store.city != $store.state } - {$store.city}{/if}</div>
		{/if}
        <div class="custom-shops-name">{$store.name}</div>
        {if $store.company != '-'}
        <div class="custom-shops-name">{$store.company}</div>
{/if}
{if $page.meta['title'] != 'Racko e-partners'} 
        <div class="">{$store.address1}</div>
        <div class="">{$store.postcode}, {$store.city}</div>
        <div class="">{$store.state}</div>
{/if}
<div class="d-flex align-itemsc
">
{if $store.phone}
<div class="custom-shops-email"><a href="tel:{$store.phone_mobile}">{$store.phone}</a> </div> {if $store.phone_mobile}
<span class="mx-2">/</span> {/if}
{/if}
{if $store.phone_mobile}
<div class="custom-shops-email">
    <a href="tel:{$store.phone_mobile}">{$store.phone_mobile}</a></div>

{/if}
</div>
        <div class="custom-shops-web"><a href="{$store.web}">{$store.web}</a></div>
			<div class="custom-shops-web"><a href="mailto:{$store.email}">{$store.email}</a></div>

      </div>
    </div>
      {/foreach}
    </div>


  </div>
      <div class="line"></div>
{foreach key=key item=store_world from=$stores_wordwide}
  <div class="row">
    <div class="col-12 custom-shops-title pb-4 text-center">{$key}</div>
    <div class="col-12 stores-inner d-flex flex-wrap">


{foreach key=key item=store from=$store_world}
<div class="col-12 col-md-4">

      <div class="custom-shop-card">
        <div class="custom-shops-name">{$store.name}</div>
        <div class="custom-shops-name">{$store.state}</div>
        <div class="">{$store.address1}</div>
        <div class="">{$store.postcode}, {$store.city}</div>


        <div class="custom-shops-email"><a>{$store.phone}</a></div>
        <div class="custom-shops-email"><a>{$store.email}</a></div>
        <div class="custom-shops-web"><a>{$store.note}</a></div>
      </div>
    </div>

    {/foreach}

    </div>


  </div>
  <div class="line"></div>
    {/foreach}

</div>
