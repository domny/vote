
{include file="../../includes/header.tpl"}

            <ul class="tabbar">
                <li><a title="" href="admin">��ҳ</a></li>
                <li class="selected"><a title="" href="itemlist">ͶƱ��Ŀ</a></li>
                <li ><a title="" href="infolist">ͶƱ��¼</a></li>
            </ul>

            <table>
                <thead>
                <th width="185px">��Ŀ����</th>
                <th>����ʱ��<i class="J_CreateTime down-order" data-value="sort=publishTime_down"><s
                        class="current"></s></i></th>
                <th>��ע</th>
                <th>״̬</th>
                <th>����</th>

                </thead>
                <tbody >

                 {foreach from=$items item=item}
                    <tr><td>{$item.name}</td><td>{$item.gmt_create}</td><td>{$item.memo}</td><td>{$item.status}</td>
                     <td><a href='/view/admin/vote_item_action.php?action=delete&id="{$item.memo}"'>ɾ��</a></td>
                   </tr>
                {/foreach}

                </tbody>
            </table>

            <div>
                <form id='addVoteItemForm'action="/view/admin/vote_item_action.php">
                    ���ƣ�<input name="name" type="text" value="">
                    ��ע��<input name="memo" type="text" value="">
                    <input name="action" type="hidden" value="add">
                    <input type="submit" value="������Ŀ">
                </form>
            </div>

{include file="../../includes/footer.tpl"}

