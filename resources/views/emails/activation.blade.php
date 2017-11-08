<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="renderer" content="webkit" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>注册验证通知邮件</title>
    <style type="text/css">
        #msg-container {
            margin: 1em auto;
            max-width: 600px;
        }
        #msg-table {
            border-collapse: collapse;
            border-spacing: 0;
            text-align: center;
        }
        #activationBtn {
            padding: 1em;
            display: inline-block;
            text-decoration: none;
            background-color: #337ab7;
            color: #fff;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }
        .msg-guide {
            text-align: left;
        }
    </style>
</head>
<body>
    <div id="msg-container">
        <table id="msg-table">
            <caption>
                <h1>注册验证通知邮件</h1>
            </caption>
            <thead>
                <tr>
                    <th>注册账户的验证和激活</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td>
                        <p>如果这不是您本人的操作，请忽略此邮件</p>
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <tr>
                    <td class="msg-guide">
                        <p>欢迎您的加入，请点击下边的“激活我的账户”按钮，完成您的注册验证和账户激活</p>
                    </td>
                </tr>
                <tr>
                    <td class="msg-feature">
                        <a id="activationBtn" href="{{ route('user.activate', $user->activation_token) }}" target="_blank">激活我的账户</a>
                    </td>
                </tr>
                <tr>
                    <td class="msg-guide">
                        <p>如果点击按钮不起作用，请复制下方链接地址，并粘贴到您浏览器的地址栏当中，再打开该链接</p>
                    </td>
                </tr>
                <tr>
                    <td class="msg-feature">
                        <a href="{{ route('user.activate', $user->activation_token) }}" target="_blank">{{ route('user.activate', $user->activation_token) }}</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>