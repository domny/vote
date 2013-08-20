
{include file="../../includes/header.tpl"}

            <ul class="tabbar">
                <li><a title="" href="admin">首页</a></li>
                <li class="selected"><a title="" href="itemlist">投票条目</a></li>
                <li ><a title="" href="infolist">投票记录</a></li>
            </ul>

            <table>
                <thead>
                <th width="185px">条目名称</th>
                <th>创建时间<i class="J_CreateTime down-order" data-value="sort=publishTime_down"><s
                        class="current"></s></i></th>
                <th>备注</th>
                <th>状态</th>
                <th>操作</th>

                </thead>
                <tbody >

                 {foreach from=$items item=item}
                    <tr><td>{$item.name}</td><td>{$item.gmt_create}</td><td>{$item.memo}</td><td>{$item.status}</td>
                     <td><a href='/view/admin/vote_item_action.php?action=delete&id="{$item.memo}"'>删除</a></td>
                   </tr>
                {/foreach}

                </tbody>
            </table>

            <div>
                <form id='addVoteItemForm'action="/view/admin/vote_item_action.php">
                    名称：<input name="name" type="text" value="">
                    备注：<input name="memo" type="text" value="">
                    <input name="action" type="hidden" value="add">
                    <input type="submit" value="新增条目">
                </form>
            </div>

{include file="../../includes/footer.tpl"}

