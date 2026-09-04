<?php
// Textos da página: programação, corpo docente e dúvidas frequentes.

$selos = ['Presencial', 'Online ao vivo', 'Gravado por 12 meses', 'Certificado UFAPE'];

$numeros = [
    'Data'              => '10 e 11 de outubro de 2026',
    'Local'             => 'Av. Tiradentes, 11, São Paulo/SP',
    'Carga horária'     => '16 horas de programação',
    'Vagas presenciais' => 'Limitadas a 260 pessoas',
];

$diferenciais = [
    'Tema de alta relevância para rotina clínica, emergência, UTI e anestesia veterinária.',
    'Discussão direcionada ao paciente cardiológico com raciocínio clínico aplicado.',
    'Integração entre cardiologia, anestesia, terapia intensiva, oxigenioterapia e nutrição.',
    'Formato híbrido: participação presencial ou online.',
    'Acesso online gravado por 12 meses na modalidade online.',
    'Capacidade presencial limitada a 260 participantes.',
    'Ação social com doação de brinquedo nas inscrições presenciais.',
    'Patrocinadores ligados a tecnologia, equipamentos e suporte à prática veterinária.',
];

$palestrantes = [
    ['nome' => 'Dr. Matheus Matioli Mantovani',        'tema' => 'Cardiopatias em cães e gatos e guia terapêutico',                    'foto' => 'matheus.jpg'],
    ['nome' => 'Dr. Alessandro Martins',               'tema' => 'Instrumentação hemodinâmica e parada cardiogênica',                  'foto' => 'alessandro.jpg'],
    ['nome' => 'M.V. Djalmo Pietruka',                 'tema' => 'POCUS direcionado ao cardiopata e VExUS',                            'foto' => 'djalmo.jpg'],
    ['nome' => 'M.V. Renan Matheus Duarte',            'tema' => 'Ventilação mecânica e vasoativos no choque',                         'foto' => 'renan.jpg'],
    ['nome' => 'Dra. Flavia Mazzo',                    'tema' => 'Arritmias na internação e seu tratamento',                           'foto' => 'flavia.jpg'],
    ['nome' => 'Dra. Mayara Travalini',                'tema' => 'Anestesia no paciente cardiopata',                                   'foto' => 'mayara.jpg'],
    ['nome' => 'MSc. Adalberto Monteiro',              'tema' => 'Anticoagulação: o que temos de evidência nos pacientes cardiopatas', 'foto' => 'adalberto.jpg'],
    ['nome' => 'M.V. Jenif da Rocha Esposito Martins', 'tema' => 'Edema pulmonar cardiogênico no pronto atendimento',                  'foto' => 'jeniff.jpg'],
    ['nome' => 'Dra. Ticiane Giselle Bitencourt',      'tema' => 'Nutrição no paciente cardiopata na internação / UTI',                'foto' => 'ticiane.jpg'],
];

$programacao = [
    '10 de outubro de 2026' => [
        ['08h30 às 09h00', 'Abertura', ''],
        ['09h00 às 10h00', 'Principais cardiopatias em cães e gatos e sua classificação', 'Dr. Matheus Matioli Mantovani'],
        ['10h00 às 11h00', 'Guia terapêutico do B2 ao D', 'Dr. Matheus Matioli Mantovani'],
        ['11h00 às 11h30', 'Intervalo', ''],
        ['11h30 às 12h30', 'POCUS direcionado ao cardiopata', 'M.V. Djalmo Pietruka'],
        ['12h30 às 13h00', 'Abordagem inicial do edema pulmonar cardiogênico no pronto atendimento', 'M.V. Jenif da Rocha Esposito Martins'],
        ['13h00 às 14h30', 'Intervalo, demonstrativo POCUS', 'M.V. Renan Matheus Duarte e M.V. Djalmo Pietruka'],
        ['14h30 às 15h30', 'Da oxigenoterapia à ventilação mecânica', 'MSc. Adalberto Monteiro'],
        ['15h30 às 16h30', 'Desmame da ventilação mecânica pós edema cardiogênico', 'M.V. Renan Matheus Duarte'],
        ['16h00 às 16h30', 'Intervalo', ''],
        ['16h30 às 17h30', 'Monitoração hemodinâmica no paciente em edema cardiogênico no leito de UTI', 'M.V. Djalmo Pietruka'],
        ['17h30 às 18h30', 'Anestesia no paciente para cirurgias cardíacas e no cardiopata para outras intervenções', 'Dra. Mayara Travalini'],
        ['18h30 às 19h30', 'Principais arritmias na internação e seu tratamento', 'Dra. Flavia Mazzo'],
        ['19h30 às 01h00', 'Coquetel', 'Rooftop'],
    ],
    '11 de outubro de 2026' => [
        ['09h00 às 10h00', 'Principais cardiopatias congênitas e seu tratamento', 'M.V. Diego Lessa (a confirmar)'],
        ['10h00 às 11h00', 'Intervencionismo cardiológico', 'M.V. Guilherme Goldfeder (a confirmar)'],
        ['11h00 às 12h00', 'Manejo do felino com cardiopatia hipertrófica', 'M.V. Ariane Oliveira'],
        ['12h00 às 13h00', 'Anticoagulação: o que temos de evidência nos pacientes cardiopatas', 'MSc. Adalberto Monteiro'],
        ['13h00 às 14h00', 'Intervalo demonstrativo, demonstração VXE', 'M.V. Djalmo Pietruka'],
        ['14h00 às 15h00', 'Uso de vasoativos no choque cardiogênico', 'M.V. Renan Matheus Duarte'],
        ['15h00 às 16h00', 'Nutrição no paciente cardiopata na internação / UTI', 'Dra. Ticiane Giselle Bitencourt'],
        ['16h00 às 17h00', 'Parada de origem cardiogênica: o que fazer', 'Dr. Alessandro Martins'],
    ],
];

// Chaves iguais às de $workshops_opcionais, em dados.php.
$workshops_detalhe = [
    'balonamento' => [
        'vagas' => 'Máximo 10 alunos',
        'itens' => [
            ['09h00 às 10h00', 'Aula teórica', 'Guilherme Zupiroli'],
            ['10h00 às 13h00', 'Aula demonstrativa e hands on in vivo de balonamento', 'Guilherme Zupiroli'],
        ],
    ],
    'hemodinamica' => [
        'vagas' => 'Máximo 10 alunos',
        'itens' => [
            ['08h00 às 10h00', 'Instrumentação hemodinâmica', 'Dr. Alessandro Martins'],
            ['09h00 às 13h00', 'Hemodinâmica básica e avançada durante procedimento cardiológico ao vivo', 'Dr. Alessandro Martins'],
        ],
    ],
    'atriosseptostomia' => [
        'vagas' => 'Máximo 10 alunos',
        'itens' => [
            ['14h00 às 16h00', 'Aula teórica', 'Dr. Carlos Eduardo Bernini'],
            ['16h00 às 18h00', 'Aula demonstrativa in vivo de atriosseptostomia', 'Dr. Carlos Eduardo Bernini'],
        ],
    ],
    'ventilacao' => [
        'vagas' => 'Máximo 10 alunos',
        'itens' => [
            ['14h00 às 15h00', 'Aula teórica', 'Dr. Renan Matheus Duarte'],
            ['15h00 às 19h00', 'Instrumentação e ventilação mecânica para procedimento cardiológico in vivo', 'Dr. Renan Matheus Duarte'],
        ],
    ],
];

$inclusos = [
    'Certificado UFAPE conforme modalidade',
    'Acesso à gravação por 12 meses',
    'Materiais complementares (apostila)',
    'Coquetel para modalidade presencial',
];

$faq = [
    ['O evento será presencial ou online?', 'O simpósio terá formato híbrido, com opção presencial e opção online transmitida e gravada.'],
    ['O acesso online fica disponível por quanto tempo?', 'Na modalidade online transmitida e gravada, o acesso ficará disponível por 12 meses.'],
    ['O presencial tem limite de vagas?', 'Sim. O número máximo presencial é de 260 pessoas.'],
    ['Há valor diferente para ex-alunos UFAPE?', 'Sim. Há condições específicas para ex-alunos da pós-graduação UFAPE, ex-alunos de cursos abertos UFAPE e demais participantes.'],
    ['A inscrição presencial exige doação?', 'Sim. Nas categorias presenciais informadas, há doação de brinquedo vinculada à inscrição.'],
    ['Quais são as formas de pagamento?', 'Pix, boleto à vista e cartão: 3x sem juros e de 4 a 10x com juros. As regras de cancelamento, transferência e reembolso seguem a política institucional da UFAPE.'],
];
