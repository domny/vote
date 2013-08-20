
{include file="../../includes/header.tpl"}


            <ul class="tabbar">
                <li><a title="" href="admin">首页</a></li>
                <li><a title="" href="itemlist">投票条目</a></li>
                <li class="selected"><a title="" href="infolist">投票记录</a></li>
            </ul>



            <table>
                <thead>
                <th width="185px">投票者</th>
                <th>投票时间<i class="J_CreateTime down-order" data-value="sort=publishTime_down"><s
                        class="current"></s></i></th>
                <th>条目编号</th>
                <th>条目名称</th>
                <th>状态</th>
                <th>备注</th>

                </thead>
                <tbody>

                 {foreach from=$items item=item}
                    <tr>
                        <td>{$item.nick}</td>
                        <td>{$item.gmt_create}</td>
                        <td>{$item.item_id}</td>
                        <td>{$item.name}</td>
                        <td>{$item.status}</td>
                        <td>{$item.memo}</td>
                   </tr>
                {/foreach}

                </tbody>
            </table>


{include file="../../includes/footer.tpl"}