{include file="../../includes/header.tpl"}
{if $id > 0}
<div>ͶƱ�ɹ�</div>
<div>����ϲ����ˮ���ǣ�{$voteItem} </div>
{/if}

<div>Ŀǰ��ͶƱ����ǣ�
    <div>
        <ul>
             {foreach from=$report item=item}
                 <li>
                    {$item.item_id}- {$item.name} �� {$item.count}
                 </li>
             {/foreach}
        </ul>

        <a href="{$myDomain}/view/front/view.php"  >��ҳ</a>
{include file="../../includes/footer.tpl"}