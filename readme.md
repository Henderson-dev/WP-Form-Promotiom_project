# WP Form Promotion ACF

### DOCUMENTAÇÃO E DETALHES DAS REGRAS DE NEGÓCIO

## Desafio

Criar uma landpage para sustentação de uma campanha promocional para o dia das mães de uma indústria de alimentos de São Paulo. A campanha vai sortear uma viagem com acompanhante para Gramado, com tudo pago!


## Regras de negócio

- A promoção vai acontecer entre os dias 15 de abril e 31 de maio
- Poderão participar da promoção, as pessoas físicas com CPF válido, maiores de dezoito anos completos, no momento do
cadastro e domiciliados no Estado de São Paulo
- Será gerado um número da sorte para cada produto comprado
- Não existe limite de números da sorte por participante, desde que obedeça a regra acima
- O participante precisa adicionar a foto do cupom fiscal com os produtos comprados da marca
- Informar as quantidades dos produtos e o código de barras de cada produto adiquirido
- Informar o nome do estabelecimento onde os produtos foram comprados
- Após o cadastro, será enviado um e-mail para o participante com os seus números da sorte
- Precisa ter documento com regulamento completo e Certificado de Autorização SECAP para realização da promoção
- Para a identificação do Número da Sorte contemplado serão considerados os 5 (cinco) primeiros prêmios da extração da Loteria Federal do dia 05 de junho seguindo as regras descritas no regulamento
- O consumidor deverá guardar consigo as embalagens, bem como as notas/cupons fiscais todas os códigos de barra cadastrados
nesta promoção. O consumidor sorteado poderá perder o direito ao prêmio se deixar de apresentar todos códigos de barras
notas/cupons fiscais sob seu CPF durante o período da Promoção.


## Campos de cadastro

- Nome completo
- E-mail
- CPF (tem que ter um validador simples em JS)
- Data de nascimento (comprovar que é maior de 18 anos)
- Telefone com ddd
- Celular com ddd
- Lista de cidades de SP (Lista de cidades de SP em ordem alfabética em um elemento select)
- UF será sempre SP
- Aceitar os termos do regulamento da promoção
- Aceitar a Política de Privacidade
- Campo para upload da imagem fotográfica do código de barras dos produtos
- Marcar que está ciente que precisa guardar os cupons fiscais cadastrados
- Nome do estabelecimento onde os produtos da marca foram adiquiridos


## Regras para geração do número da sorte

• 2 algarismos de 00 a 19, gerados de forma sequencial + ponto + 5 algarismos de 00001 a 99999, gerados de forma aleatória

Exemplos:
- 00.00000
- 01.38747
- 05.47294
- 19.69205

Ou seja:
Se eu me cadastrei na promoção, vou receber o número 00.92494, onde o 00 é seguindo a ordem e o 92494 é aleatório;
Depois, a próxima pessoa a se cadastrar vai receber 01.52493, onde o 01 é seguindo a ordem e o 52493 é aleatório;
A próxima pessoa recebe um 02. e assim por diante, até o 19. Ao chegar no número 19, volta pra 00.

Se eu cadastrei vários produtos no mesmo cupom, eu recebo a quantidade de números da sorte iguais ao número de produtos que eu disse que comprei, todos com o mesmo 00, e vários aleatórios.

Se comprei 5 produtos, receberei os números:

- 00.47493
- 00.47395
- 00.85730
- 00.18547
- 00.48603


# Segurança

- Validar campos
- Validar CPF
- Verificar data de nascimento (precisa ser maior de 18 anos)
- Permitir no upload de arquivos apenas imagens em formatos JPG e PNG
- Limitar em 4MB o tamanho dos arquivos de upload
- Ter um Captcha para evitar cadastros por robôs


# LGPD
- Ter um termo completo sobre uso dos dados enviados pelos participantes da promoção
- Os dados dos participante são mantidos na base online da landpage somente até o fim da promoção
- Ao terminar a promoção, a realização do sorteio e identificação dos ganhadores a base de dados e desativada
- As imagens dos cupons fiscais serão armazenadas em servidor online durante o período da promoção e excluídas após o termino da promoção


# Insights
- Um agente de IA que extrai os dados do cupom fiscal, extraindo os produtos da marca e gerando os números da sorte
- O mesmo agente ser capaz de verificar se o recibo já foi usado antes


# Soluções
• Criar páginas personalizadas no Wordpress para promoção
• Criar um custom post chamado promoções usando o plugin Custom Post Type UI
https://br.wordpress.org/plugins/custom-post-type-ui/

• Criar os campos de cadastro usando ACF (Advanced Custom Fields)
https://br.wordpress.org/plugins/advanced-custom-fields/

• Usar o plguin WP Mail SMTP para configurar uma conta segura para envio dos e-mails
https://br.wordpress.org/plugins/wp-mail-smtp/

• Usar um plugin completo para segurança como Wordfence
https://wordpress.org/plugins/wordfence/

• Usar um plugin de backup - UpdraftPlus
https://br.wordpress.org/plugins/updraftplus/



# Detalhes

- Validar os campos no front end com Java Script
- Para o processo de upload usar as funções nativas do Wordpress
- Criar uma função para gerar os números da sorte e salvar o número no título e slug do custom post
- Usar a função wp_insert_post() para criar um novo post de promoção
- Iserir os dados do formulário no novo post com a função update_field()
- Enviar o e-mail com a função wp_mail() nativa do Wordpress


# Resultados

- Um participante conseguiu gerar vários números da sorte com o mesmo cupom fiscal


# Observações

O Certificado de Autorização SECAP é um documento emitido pela Secretaria de Avaliação, Planejamento, Energia e Loteria (SECAP) que comprova a autorização para a realização de promoções comerciais, como sorteios, concursos ou similares. Este certificado é essencial para a legalidade e divulgação de campanhas promocionais, devendo constar de forma legível em todos os materiais publicitários.