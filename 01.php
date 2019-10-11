// 是否推荐 --------------------------------------------------------
// html
<td style="cursor: pointer" id="{$val.id}" istop="{$val.is_top}" class="arttop">{if $val.is_top == 1}<span class="btn-success">是</span>{else /}<span class="btn-darkorange">否</span>{/if}</td>
// 是否推荐修改
        $('.arttop').click(function () {
            var id = $(this).attr('id');
            var is_top = $(this).attr('istop');
            $.ajax({
                url: "{:url('admin/articles/top')}",
                data: {id: id, is_top: is_top},
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    if (data.code == 1) {
                        layer.msg(data.msg, {
                            icon: 6,
                        }, function () {
                            location.href = data.url;
                        })
                    } else {
                        layer.open({
                            content: data.msg,
                            icon: 5,
                            anim: 6
                        })
                    }
                }
            });
            return false;
        });
        
// php
// 修改是否推荐
    public function top()
    {
        $data = [
            'id'     => input('post.id'),
            'is_top' => input('post.is_top') ? 0 : 1, // 有0没有1
        ];
        $res  = model('article')->top($data);
        if ($res == 1) {
            return $this->success('修改成功', 'admin/articles/list');
        } else {
            return $this->error($res);
        }
    }
