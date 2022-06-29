<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pass</title>
</head>

<body style="background-color: #eee; font-family: Arial, Helvetica, sans-serif; max-resolution: 0 auto; padding: 0;">

    <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="D7D7D7">
        <div
            style=" margin: 0 auto; max-width: 50%; min-width: 35%; background-color: rgb(42, 42, 70); padding: 10px 20px; color: aliceblue;">
            <h1 style="text-align: center;">{{config("app.name")}}</h1>
        </div>
        <div
            style=" margin: 0 auto; max-width: 50%; min-width: 35%; background-color: white; padding: 10px 20px; color: aliceblue; border-bottom: 3px solid  #eee ;">
            <h2 style="text-align: center; color: #222;">Bem vindo a nossa plataforma</h2>
        </div>
        <div style=" margin: 0 auto; max-width: 50%; min-width: 35%; background-color: white; padding: 10px 20px;
        color: #777; border-top: 1px thick #ccc; border-bottom: 1px thick #ccc;
        font-size: 14px; line-height: 19px;
        ">

            <p> Olá <b>{{$user->name}}</b>, tudo bom? </p>

            <p>Sua senha de acesso a plataforma {{config("app.name")}} foi criada com sucesso.</p>

            <p>Faça seu login com os dados abaixo:</p>
            <p>
                email: {{$user->email}} <br>
                senha: {{$user->cpf}}

            </p>
            <p>Link de acesso a plataforma: {{ url('/') }}/login</p>
            <p> <b>Equipe Compliance</b> </p>

        </div>
        <div style=" margin: 0 auto; border-top: 3px solid #eee; max-width: 50%; min-width: 35%; background-color: white; padding: 10px 20px;
        color: #999;  font-size: 12px; line-height: 16px; text-align: justify;">

            <p>
                A Compliance - Título Corretora de Valores SA, inscrita no CNPJ/ME sob nº 62.169.875/0001-79 ("Nu
                invest"), instituição financeira autorizada a funcionar pelo Banco Central do Brasil, informa que os
                recursos de clientes são mantidos em suas contas de registro que são utilizadas exclusivamente pelo Nu
                invest para registro das operações de cada cliente, como previsto no artigo 14-A do Regulamento Anexo à
                Resolução CMN nº 1.655. As contas de registro não se confundem com as contas de pagamento, que estão
                definidas pelos artigos 6º, inciso IV, e 12 da Lei nº 12.865/2013, e os recursos mantidos nas contas de
                registro não possuem regime jurídico equivalente ao dos recursos mantidos em contas de pagamento, nos
                termos previstos no artigo 12 da Lei nº 12.865/2013.
            </p>
            <p>
                Toda transmissão de ordem por meio digital está sujeita a interrupções ou atrasos, podendo impedir ou
                prejudicar o envio de ordens ou a recepção de informações atualizadas. </p>



        </div>

    </table>


</body>

</html>