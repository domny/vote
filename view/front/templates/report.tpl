{include file="../../includes/header.tpl"}
{if $id > 0}
<div>投票成功</div>
<div>你最喜欢的水果是：{$voteItem} </div>
{/if}

<div>目前的投票结果是：
    <div>
        <ul>
             {foreach from=$report item=item}
                 <li>
                    {$item.item_id}- {$item.name} ： {$item.count}
                 </li>
             {/foreach}
        </ul>

        <a href="{$myDomain}/view/front/view.php"  >首页</a>
{include file="../../includes/footer.tpl"}