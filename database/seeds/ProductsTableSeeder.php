<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Product;
class ProductsTableSeeder extends Seeder
{

    public function run()
    {
        
        $productos_json = '[
            {
                "nombre": "PAN",
            "productos": [
              {
                "id": 1,
                "nombre": "BARRA DE PAN"
              },
              {
                "id": 2,
                "nombre": "BARRA INTEGRAL"
              },
              {
                "id": 3,
                "nombre": "BARRA SIN SAL"
              },
              {
                "id": 5,
                "nombre": "PAN CASERO GRANDE"
              },
              {
                "id": 6,
                "nombre": "PAN CASERO PEQUEÑO"
              },
              {
                "id": 7,
                "nombre": "PAN FIBRA"
              },
              {
                "id": 8,
                "nombre": "MALECHA"
              },
              {
                "id": 10,
                "nombre": "BASTON"
              },
              {
                "id": 11,
                "nombre": "CHAPATA CASERA"
              },
              {
                "id": 13,
                "nombre": "BAGUETTE GRANDE"
              },
              {
                "id": 14,
                "nombre": "BAGUETTE PEQUEÑA"
              },
              {
                "id": 15,
                "nombre": "PULGAS"
              },
              {
                "id": 16,
                "nombre": "PANECILLO DE LECHE"
              },
              {
                "id": 18,
                "nombre": "TORTA DE ACEITE"
              },
              {
                "id": 19,
                "nombre": "ROLLO GALLEGO"
              },
              {
                "id": 20,
                "nombre": "BARRA GALLEGA"
              },
              {
                "id": 21,
                "nombre": "PAN SOBAO PEQUEÑO"
              },
              {
                "id": 303,
                "nombre": "PULGAS DE MICKEY"
              },
              {
                "id": 308,
                "nombre": "PANECILLO INTEGRAL"
              },
              {
                "id": 313,
                "nombre": "PANECILLOS CEREALES"
              },
              {
                "id": 315,
                "nombre": "PULGAS DE CHAPATA"
              },
              {
                "id": 360,
                "nombre": "BARRAS DE CUADROS CASERAS"
              },
              {
                "id": 362,
                "nombre": "BARRA DE LATA"
              },
              {
                "id": 405,
                "nombre": "PAN VIENES"
              },
              {
                "id": 452,
                "nombre": "BAGUETTE MULTICEREALES"
              },
              {
                "id": 453,
                "nombre": "PANECILLOS DE SOJA"
              },
              {
                "id": 482,
                "nombre": "PAN PARA RELLENOS"
              },
              {
                "id": 542,
                "nombre": "BARRA DE DEDOS"
              },
              {
                "id": 595,
                "nombre": "PAN CASERO MEDIANO"
              },
              {
                "id": 668,
                "nombre": "PULGUITA TAPA"
              },
              {
                "id": 693,
                "nombre": "BARRON"
              },
              {
                "id": 702,
                "nombre": "COLINES"
              },
              {
                "id": 712,
                "nombre": "CHAPATA DE CEREALES"
              },
              {
                "id": 764,
                "nombre": "MINI PULGAS DE CHAPATA"
              },
              {
                "id": 766,
                "nombre": "BARRA RUSTICA"
              },
              {
                "id": 772,
                "nombre": "PAN DE ESPELTA"
              },
              {
                "id": 778,
                "nombre": "TORTA DE MAIZ DULCE"
              },
              {
                "id": 872,
                "nombre": "PAN SIN GLUTEN"
              },
              {
                "id": 875,
                "nombre": "PAN COLESTEROL"
              },
              {
                "id": 876,
                "nombre": "BAGUETTE INTEGRAL"
              },
              {
                "id": 877,
                "nombre": "PANECILLO SUPREMA"
              },
              {
                "id": 880,
                "nombre": "PAN DURO "
              },
              {
                "id": 882,
                "nombre": "PAYESITO NORMAL"
              },
              {
                "id": 883,
                "nombre": "PAYESITO CENTENO"
              },
              {
                "id": 884,
                "nombre": "PAYESITO CEREALES"
              },
              {
                "id": 912,
                "nombre": "PULGA ROMBO"
              },
              {
                "id": 915,
                "nombre": "PEPITO"
              },
              {
                "id": 942,
                "nombre": "BARRA CRISTINA SOJA Y AVENA"
              },
              {
                "id": 987,
                "nombre": "ROLLO CUADROS"
              },
              {
                "id": 993,
                "nombre": "PANECILLO 7 CEREALES"
              },
              {
                "id": 1032,
                "nombre": "PAN SOBAO GRANDE"
              },
              {
                "id": 1067,
                "nombre": "PAN CORAZON"
              },
              {
                "id": 1074,
                "nombre": "REGAÑAS"
              },
              {
                "id": 1076,
                "nombre": "CHAPATA MAIZ"
              },
              {
                "id": 1109,
                "nombre": "PANECILLO CENTENO"
              },
              {
                "id": 1113,
                "nombre": "PAN MASA MADRE"
              },
              {
                "id": 1118,
                "nombre": "PAN HAMBURGUESA CASERO"
              },
              {
                "id": 1143,
                "nombre": "PAN DE CRISTAL"
              },
              {
                "id": 1151,
                "nombre": "PAN DE AVENA"
              },
              {
                "id": 1154,
                "nombre": "BOLSA COLINES"
              },
              {
                "id": 1155,
                "nombre": "MOLLETE DE ANTEQUERA"
              },
              {
                "id": 1156,
                "nombre": "BARRA TORRIJAS"
              },
              {
                "id": 1158,
                "nombre": "PAN CENTENO"
              },
              {
                "id": 1167,
                "nombre": "CHAPATA INTEGRAL"
              },
              {
                "id": 1204,
                "nombre": "AVENETES DE CRISTINA"
              }
            ]
          },
          {
            "nombre": "BIZCOCHOS",
            "productos": [
              {
                "id": 4,
                "nombre": "BIZCOCHO NORMAL"
              },
              {
                "id": 22,
                "nombre": "BIZCOCHO CHOCOLATE"
              },
              {
                "id": 23,
                "nombre": "BIZCOCHO CAFE"
              },
              {
                "id": 24,
                "nombre": "BIZCOCHO ALMENDRA"
              },
              {
                "id": 25,
                "nombre": "BIZCOCHO NARANJA"
              },
              {
                "id": 26,
                "nombre": "BIZCOCHO MUERTE POR CHOCOLATE"
              },
              {
                "id": 27,
                "nombre": "BIZCOCHO BICOLOR"
              },
              {
                "id": 28,
                "nombre": "PORCION BIZCOCHO"
              },
              {
                "id": 29,
                "nombre": "BIZCOCHO PIÑA Y COCO"
              },
              {
                "id": 30,
                "nombre": "BIZCOCHO LACASITOS"
              },
              {
                "id": 31,
                "nombre": "BIZCOCHO CEREALES"
              },
              {
                "id": 32,
                "nombre": "BIZCOCHO RELLENO DE NATA"
              },
              {
                "id": 33,
                "nombre": "BIZCOCHO MANZANA"
              },
              {
                "id": 375,
                "nombre": "BIZCOCHO DE YOGURT"
              },
              {
                "id": 523,
                "nombre": "BIZCOCHO MUERTE POR CHOCO BLANCO FRAMBUE"
              },
              {
                "id": 816,
                "nombre": "PLANCHA DE BIZCOCHO"
              },
              {
                "id": 926,
                "nombre": "PORCION BIZCOCHO LACASITOS 1 Ñ"
              },
              {
                "id": 950,
                "nombre": "BIZCOCHO LIMON Y TOFFEE"
              },
              {
                "id": 957,
                "nombre": "BIZCOCHO RED - WHITE"
              },
              {
                "id": 1120,
                "nombre": "BIZCOCHO 100% ACEITE DE OLIVA"
              },
              {
                "id": 1138,
                "nombre": "PANETTONE"
              },
              {
                "id": 807,
                "nombre": "BIZCOCHO SIN AZUCAR"
              },
              {
                "id": 1169,
                "nombre": "BIZCOCHO SIN HUEVO"
              },
              {
                "id": 1186,
                "nombre": "BIZCOCHO ZANAHORIA"
              },
              {
                "id": 1199,
                "nombre": "BIZCOCHO TIGRE"
              },
              {
                "id": 1200,
                "nombre": "BIZCOCHO NUTELLA"
              },
              {
                "id": 1201,
                "nombre": "BIZCOCHO CANELA Y MIEL"
              },
              {
                "id": 1202,
                "nombre": "BIZCOCHO INTEGRAL"
              },
              {
                "id": 1203,
                "nombre": "BIZCOCHO LIMON Y CARAMELO"
              }
            ]
          },
          {
            "nombre": "ROLLOS Y FRITOS CASEROS",
            "productos": [
              {
                "id": 36,
                "nombre": "ROLLOS FRITOS"
              },
              {
                "id": 37,
                "nombre": "BUÑUELOS DE CREMA"
              },
              {
                "id": 38,
                "nombre": "XUXOS GRANDES"
              },
              {
                "id": 39,
                "nombre": "XUXOS PEQUEÑOS"
              },
              {
                "id": 40,
                "nombre": "FRITILLAS"
              },
              {
                "id": 41,
                "nombre": "ROLLOS DE AMOR"
              },
              {
                "id": 42,
                "nombre": "ROLLOS DE VINO"
              },
              {
                "id": 461,
                "nombre": "ROLLOS DE ANIS"
              },
              {
                "id": 462,
                "nombre": "ROLLOS DE HUEVO"
              },
              {
                "id": 44,
                "nombre": "PASTAS DE TE"
              },
              {
                "id": 324,
                "nombre": "TALLOS"
              },
              {
                "id": 354,
                "nombre": "TORRIJAS"
              },
              {
                "id": 904,
                "nombre": "ROLLOS DE ACEITE"
              },
              {
                "id": 905,
                "nombre": "PASTAS DE HUEVO"
              }
            ]
          },
          {
            "nombre": "MAGDALENAS",
            "productos": [
              {
                "id": 45,
                "nombre": "MAGDALENAS REDONDAS DOCENA"
              },
              {
                "id": 48,
                "nombre": "MAGDALENAS CUADRADAS DOCENA"
              },
              {
                "id": 51,
                "nombre": "MAGDALENAS ACEITE OLIVA DOCENA"
              },
              {
                "id": 54,
                "nombre": "RAMONA UNIDAD"
              },
              {
                "id": 55,
                "nombre": "MAGDALENA BAÑADA CHOCOLATE DOCENA"
              },
              {
                "id": 57,
                "nombre": "MAGDALENAS RELLENAS DE CHOCO"
              },
              {
                "id": 306,
                "nombre": "MINI MAGDALENAS VARIADAS"
              },
              {
                "id": 630,
                "nombre": "MINI MAGDALENAS CON FONDANT DE COLORES"
              },
              {
                "id": 804,
                "nombre": "MUFFINS OREO"
              },
              {
                "id": 860,
                "nombre": "MAGDALENAS CARAMELO Y NARANJA"
              },
              {
                "id": 919,
                "nombre": "RAMONAS BAÑADAS EN CHOCOLATE"
              },
              {
                "id": 988,
                "nombre": "MUFFINS MILKA"
              },
              {
                "id": 1025,
                "nombre": "MAGDALENAS SIN AZUCAR CASERAS"
              }
            ]
          },
          {
            "nombre": "EMPANADAS Y EMPANADILLAS",
            "productos": [
              {
                "id": 59,
                "nombre": "EMPANADILLA HOJALDRE"
              },
              {
                "id": 60,
                "nombre": "EMPANADILLA DE PASTA"
              },
              {
                "id": 61,
                "nombre": "EMPANADILLA INTEGRAL"
              },
              {
                "id": 62,
                "nombre": "EMPANADILLA DE VERDURA"
              },
              {
                "id": 63,
                "nombre": "EMPANADILLA PEQUEÑA"
              },
              {
                "id": 64,
                "nombre": "EMPANADA TOMATE"
              },
              {
                "id": 65,
                "nombre": "EMPANADA YORK Y BECHAMEL"
              },
              {
                "id": 66,
                "nombre": "EMPANADA ESPINACAS Y BECHAMEL"
              },
              {
                "id": 67,
                "nombre": "EMPANADA ATUN Y CEBOLLA"
              },
              {
                "id": 68,
                "nombre": "EMPANADA DE VERDURA"
              },
              {
                "id": 359,
                "nombre": "EMPANADILLAS DE HORTALIZAS"
              },
              {
                "id": 746,
                "nombre": "EMPANADILLA MINI MORCILLA"
              },
              {
                "id": 746,
                "nombre": "EMPANADILLA MINI JAMON YORK"
              },
              {
                "id": 746,
                "nombre": "EMPANADILLA MINI ESPINACAS"
              },
              {
                "id": 844,
                "nombre": "EMPANADA DE POLLO"
              },
              {
                "id": 1055,
                "nombre": "EMPANADA MORCILLA"
              }
            ]
          },
          {
            "nombre": "CROISSANTS",
            "productos": [
              {
                "id": 69,
                "nombre": "CROISSANTS GRANDE"
              },
              {
                "id": 70,
                "nombre": "CROISSANTS PEQUEÑO NORMAL"
              },
              {
                "id": 71,
                "nombre": "CROISSANTS PEQUEÑO GELATINA"
              },
              {
                "id": 72,
                "nombre": "CROISSANTS PEQUEÑO INTEGRAL"
              },
              {
                "id": 73,
                "nombre": "CROISSANTS PEQUEÑO CHOCO"
              },
              {
                "id": 74,
                "nombre": "CROISSANTS PEQUEÑO NATA"
              },
              {
                "id": 75,
                "nombre": "CROISSANTS GRANDE RELLENO"
              },
              {
                "id": 481,
                "nombre": "CROISSANT SIN AZUCAR"
              },
              {
                "id": 895,
                "nombre": "CROISSANTS MANTEQUILLA"
              },
              {
                "id": 903,
                "nombre": "ARTESANITO CHOCOLATE "
              },
              {
                "id": 903,
                "nombre": "ARTESANITO CHOCOLATE BLANCO"
              },
              {
                "id": 920,
                "nombre": "CROISSANT EXTRAMINI"
              },
              {
                "id": 921,
                "nombre": "CROISSANT GRANDE RECUBIERTO"
              },
              {
                "id": 1144,
                "nombre": "HURANAN CREMA"
              },
              {
                "id": 1178,
                "nombre": "HURACAN CHOCO"
              },
              {
                "id": 1188,
                "nombre": "HURACAN KINDER"
              }
            ]
          },
          {
            "nombre": "BOLLERIA DULCE",
            "productos": [
              {
                "id": 76,
                "nombre": "NAPOLITANA CHOCO"
              },
              {
                "id": 77,
                "nombre": "NAPOLITANA CREMA"
              },
              {
                "id": 78,
                "nombre": "ENSAIMADA GRANDE"
              },
              {
                "id": 79,
                "nombre": "ENSAIMADA PEQUEÑA"
              },
              {
                "id": 80,
                "nombre": "ENSAIMADA GIGANTE DE CABELLO"
              },
              {
                "id": 81,
                "nombre": "BOLLOS DE MOSTO"
              },
              {
                "id": 82,
                "nombre": "BOLLOS DE LECHE"
              },
              {
                "id": 83,
                "nombre": "BOLLO RELLENO VARIADO"
              },
              {
                "id": 84,
                "nombre": "CUERNOS CHOCO NEGRO"
              },
              {
                "id": 85,
                "nombre": "CUERNO CHOCO BLANCO"
              },
              {
                "id": 86,
                "nombre": "DONUT NORMAL"
              },
              {
                "id": 87,
                "nombre": "DONUT CHOCO NEGRO"
              },
              {
                "id": 88,
                "nombre": "DONUT CHOCO BLANCO"
              },
              {
                "id": 88,
                "nombre": "DONUT CHOCO ROSA"
              },
              {
                "id": 1106,
                "nombre": "DONUT COOKIE"
              },
              {
                "id": 1132,
                "nombre": "DONUT OREO"
              },
              {
                "id": 89,
                "nombre": "BOMBA DE CHOCO"
              },
              {
                "id": 90,
                "nombre": "BOMBA DE CREMA"
              },
              {
                "id": 91,
                "nombre": "FLAUTAS"
              },
              {
                "id": 92,
                "nombre": "MININAPO CHOCOLATE"
              },
              {
                "id": 96,
                "nombre": "CREMALLERAS CASERAS"
              },
              {
                "id": 100,
                "nombre": "CARACOLAS DE PASAS"
              },
              {
                "id": 304,
                "nombre": "MINI BOMBAS"
              },
              {
                "id": 305,
                "nombre": "MINI DONUTS"
              },
              {
                "id": 325,
                "nombre": "CORAZON DE CREMA Y CABELLO"
              },
              {
                "id": 335,
                "nombre": "BOLLO RELLENO GRANDE"
              },
              {
                "id": 358,
                "nombre": "TORTA DE PASAS Y NUECES"
              },
              {
                "id": 361,
                "nombre": "CREMADILLAS"
              },
              {
                "id": 367,
                "nombre": "ENSAIMADAS RELLENA PEQUEÑAS CREMA"
              },
              {
                "id": 367,
                "nombre": "ENSAIMADAS RELLENA PEQUEÑAS CHOCO"
              },
              {
                "id": 367,
                "nombre": "ENSAIMADAS RELLENA PEQUEÑAS NATA"
              },
              {
                "id": 367,
                "nombre": "ENSAIMADAS RELLENA PEQUEÑAS CABELLO"
              },
              {
                "id": 374,
                "nombre": "CANDELARIAS"
              },
              {
                "id": 473,
                "nombre": "BOLLITOS  DE LECHE CON PEPITAS"
              },
              {
                "id": 854,
                "nombre": "DONUT NATA"
              },
              {
                "id": 922,
                "nombre": "ENSAIMADA EXTRA MINI"
              },
              {
                "id": 962,
                "nombre": "MAGDALENEROS CON CREMA"
              },
              {
                "id": 1146,
                "nombre": "NAPOLITANA BICOLOR CHOCO-CREMA"
              },
              {
                "id": 1147,
                "nombre": "MINI DONUTS COLORES"
              },
              {
                "id": 1148,
                "nombre": "BOMBITAS COLORES"
              },
              {
                "id": 1168,
                "nombre": "BOMBAS CASERAS"
              }
            ]
          },
          {
            "nombre": "PALMERAS Y HOJALDRES DULCE",
            "productos": [
              {
                "id": 97,
                "nombre": "MINIHERRADURAS"
              },
              {
                "id": 111,
                "nombre": "PALMERA GRANDE NORMAL"
              },
              {
                "id": 112,
                "nombre": "PALMERA GRANDE  CHOCO"
              },
              {
                "id": 113,
                "nombre": "PALMERA GRANDE CHOCO BLANCO"
              },
              {
                "id": 114,
                "nombre": "PALMERA GRANDE YEMA TOSTADA"
              },
              {
                "id": 115,
                "nombre": "PALMERA GRANDE CHOCO Y NATA"
              },
              {
                "id": 116,
                "nombre": "PALMERA PEQUEÑA NORMAL Y CHOCO"
              },
              {
                "id": 117,
                "nombre": "PALMERA PEQUEÑA CEREALES"
              },
              {
                "id": 118,
                "nombre": "TORTELES"
              },
              {
                "id": 119,
                "nombre": "CAÑAS"
              },
              {
                "id": 120,
                "nombre": "TRIANGULOS DULCES"
              },
              {
                "id": 121,
                "nombre": "HERRADURAS"
              },
              {
                "id": 329,
                "nombre": "BRAZO DE HOJALDRE"
              },
              {
                "id": 331,
                "nombre": "EMPANADA DE CABELLO CON PIÑONES"
              },
              {
                "id": 471,
                "nombre": "ESNARRAS PIÑONES"
              },
              {
                "id": 472,
                "nombre": "ESNARRAS DE ALMENDRAS"
              },
              {
                "id": 483,
                "nombre": "CAÑAS DE CREMA"
              },
              {
                "id": 902,
                "nombre": "CORTADITOS"
              },
              {
                "id": 1119,
                "nombre": "PALMERA KINDER"
              }
            ]
          },
          {
            "nombre": "TORTAS",
            "productos": [
              {
                "id": 122,
                "nombre": "TORTAS GRANDES DE MANTECA NORMAL"
              },
              {
                "id": 123,
                "nombre": "TORTA GRANDE MANTECA CHOCO"
              },
              {
                "id": 124,
                "nombre": "TORTA GRANDE DE MANTECA MIXTA"
              },
              {
                "id": 125,
                "nombre": "TORTA GRANDE DE ACEITE"
              },
              {
                "id": 126,
                "nombre": "TORTA GRANDE SECA"
              },
              {
                "id": 127,
                "nombre": "TORTA PEQUEÑA SECA"
              },
              {
                "id": 128,
                "nombre": "TORTA PEQUEÑA NORMAL"
              },
              {
                "id": 129,
                "nombre": "TORTA PEQUEÑA CHOCO NEGRO Y BLANCO"
              },
              {
                "id": 513,
                "nombre": "TORTAS SECAS LIMON"
              },
              {
                "id": 727,
                "nombre": "TORTAS DE MANTECA CON NUECES"
              },
              {
                "id": 863,
                "nombre": "TORTAS SECAS CON CHOCOLATE"
              },
              {
                "id": 892,
                "nombre": "TORTAS DE ACEITE Y LIMON"
              }
            ]
          },
          {
            "nombre": "HOJALDRE Y BOLLERIA SALADA",
            "productos": [
              {
                "id": 130,
                "nombre": "BRETONES"
              },
              {
                "id": 131,
                "nombre": "PARMESANOS"
              },
              {
                "id": 132,
                "nombre": "TRIANGULOS SALADOS"
              },
              {
                "id": 133,
                "nombre": "PAN PIZZA JAMON YORK"
              },
              {
                "id": 133,
                "nombre": "PAN PIZZA ATUN"
              },
              {
                "id": 135,
                "nombre": "NAPOLITANA YORK Y QUESO"
              },
              {
                "id": 136,
                "nombre": "ARTESANITOS SALADOS"
              },
              {
                "id": 137,
                "nombre": "SALADITOS"
              },
              {
                "id": 138,
                "nombre": "BOCADITOS SALADOS"
              },
              {
                "id": 515,
                "nombre": "REJA DE JAMON YORK Y QUESO"
              },
              {
                "id": 577,
                "nombre": "CHAPATA-PIZZA"
              },
              {
                "id": 667,
                "nombre": "MINI PARMESANO"
              },
              {
                "id": 887,
                "nombre": "PASTEL MURCIANO"
              },
              {
                "id": 959,
                "nombre": "PASTEL DE CARNE"
              },
              {
                "id": 1089,
                "nombre": "MINIPIZZA"
              }
            ]
          },
          {
            "nombre": "BOCADILLOS",
            "productos": [
              {
                "id": 139,
                "nombre": "TOMATE FRITO"
              },
              {
                "id": 140,
                "nombre": "TOMATE NATURAL"
              },
              {
                "id": 141,
                "nombre": "LECHUGA"
              },
              {
                "id": 142,
                "nombre": "SALSA YOGURT"
              },
              {
                "id": 143,
                "nombre": "SALSA KEBAB"
              },
              {
                "id": 144,
                "nombre": "JAMON"
              },
              {
                "id": 334,
                "nombre": "BACON"
              },
              {
                "id": 396,
                "nombre": "TORTILLA"
              },
              {
                "id": 475,
                "nombre": "MAYONESA"
              },
              {
                "id": 565,
                "nombre": "ATUN"
              },
              {
                "id": 677,
                "nombre": "PAVO"
              },
              {
                "id": 680,
                "nombre": "POLLO TRUFADO"
              },
              {
                "id": 681,
                "nombre": "CARNE KEBAB TERNERA"
              },
              {
                "id": 806,
                "nombre": "CARNE KEBAB POLLO"
              },
              {
                "id": 835,
                "nombre": "CHORIZO"
              },
              {
                "id": 842,
                "nombre": "SALCHICHON"
              },
              {
                "id": 845,
                "nombre": "QUESO"
              }
            ]
          },
          {
            "nombre": "MIGUELITOS",
            "productos": [
              {
                "id": 145,
                "nombre": "MIGUELITO DOCENA CREMA"
              },
              {
                "id": 146,
                "nombre": "MIGUELITO MEDDIA DOCENA CREMA"
              },
              {
                "id": 148,
                "nombre": "MIGUELITO DOCENA CHOCO"
              },
              {
                "id": 149,
                "nombre": "MIGUELITO MEDIA DOCENA CHOCO"
              },
              {
                "id": 1165,
                "nombre": "MIGUELITOS KINDER 6 UNID"
              }
            ]
          },
          {
            "nombre": "PASTELERIA",
            "productos": [
              {
                "id": 93,
                "nombre": "MINI TARTALETA MANZANA"
              },
              {
                "id": 94,
                "nombre": "TARTALETA MANZANA GRANDE"
              },
              {
                "id": 151,
                "nombre": "TARTA DE MANZANA"
              },
              {
                "id": 152,
                "nombre": "TARTA FRESAS"
              },
              {
                "id": 153,
                "nombre": "TARTA DE FRUTAS"
              },
              {
                "id": 154,
                "nombre": "PEZUÑA GRANDE"
              },
              {
                "id": 154,
                "nombre": "RIÑON GRANDE"
              },
              {
                "id": 154,
                "nombre": "PALO CATALAN CREMA GRANDE"
              },
              {
                "id": 154,
                "nombre": "PALO CATALAN NATA GRANDE"
              },
              {
                "id": 154,
                "nombre": "PALO CATALAN TRUFA GRANDE"
              },
              {
                "id": 154,
                "nombre": "CUBILETE"
              },
              {
                "id": 155,
                "nombre": "PASTEL MINI"
              },
              {
                "id": 162,
                "nombre": "VELAS NUMEROS"
              },
              {
                "id": 311,
                "nombre": "PASTEL RUSO"
              },
              {
                "id": 312,
                "nombre": "MILHOJAS"
              },
              {
                "id": 316,
                "nombre": "TRONCO CHOCOLATE BLANCO"
              },
              {
                "id": 317,
                "nombre": "TRONCO CHOCO NEGRO"
              },
              {
                "id": 321,
                "nombre": "PAN DE CALATRAVA"
              },
              {
                "id": 341,
                "nombre": "TRONCOS DE NAVIDAD GRANDE"
              },
              {
                "id": 368,
                "nombre": "TARTA HELLO KITTY"
              },
              {
                "id": 369,
                "nombre": "TARTA BOB ESPONJA"
              },
              {
                "id": 376,
                "nombre": "TARTAS DE SAN VALENTIN"
              },
              {
                "id": 378,
                "nombre": "TARTAS FRESAS CORAZON"
              },
              {
                "id": 381,
                "nombre": "TARTA DE FRUTAS INDIVIDUAL"
              },
              {
                "id": 416,
                "nombre": "TARTA MANZANA REDONDA"
              },
              {
                "id": 418,
                "nombre": "SEMIFRIOS 3 CHOCOLATES"
              },
              {
                "id": 418,
                "nombre": "SEMIFRIOS NARANJA"
              },
              {
                "id": 418,
                "nombre": "SEMIFRIOS LIMON"
              },
              {
                "id": 419,
                "nombre": "SEMIFRIOS SAN MARCOS"
              },
              {
                "id": 418,
                "nombre": "SEMIFRIOS TIRAMISU"
              },
              {
                "id": 418,
                "nombre": "SEMIFRIOS FRESA"
              },
              {
                "id": 418,
                "nombre": "SEMIFRIOS CHOCOLATE"
              },
              {
                "id": 419,
                "nombre": "SEMIFRIOS NATA NUECES"
              },
              {
                "id": 423,
                "nombre": "CARDENAL FRESA"
              },
              {
                "id": 423,
                "nombre": "CARDENAL CHOCOLATE"
              },
              {
                "id": 423,
                "nombre": "CARDENAL LIMON"
              },
              {
                "id": 464,
                "nombre": "TARTAS DIA DEL PADRE"
              },
              {
                "id": 525,
                "nombre": "ESTUCHE DE PASTELES VARIADOS"
              },
              {
                "id": 788,
                "nombre": "TARTA DIA DE LA MADRE"
              },
              {
                "id": 928,
                "nombre": "TRONCO NAVIDAD PEQUEÑO"
              },
              {
                "id": 989,
                "nombre": "TARTALETA NUECES CHOCO"
              },
              {
                "id": 990,
                "nombre": "TARTALETA MANZANA CACAHUETE"
              },
              {
                "id": 1087,
                "nombre": "TARTA QUESO "
              },
              {
                "id": 1116,
                "nombre": "TARTAS FROZEN"
              },
              {
                "id": 1117,
                "nombre": "PANACOTA DE TOFFE Y CHOCOLATE BLANCO"
              },
              {
                "id": 1159,
                "nombre": "TARTA OREO"
              },
              {
                "id": 1205,
                "nombre": "PUDIN DE CAFE"
              }
            ]
          },
          {
            "nombre": "ALIMENTACION",
            "productos": [
              {
                "id": 254,
                "nombre": "HUEVOS "
              },
              {
                "id": 256,
                "nombre": "HARINA "
              },
              {
                "id": 326,
                "nombre": "GAZPACHOS"
              },
              {
                "id": 474,
                "nombre": "HARINA DE FUERZA"
              },
              {
                "id": 589,
                "nombre": "TORTA DE GAZPACHO"
              },
              {
                "id": 601,
                "nombre": "LEVADURA"
              },
              {
                "id": 691,
                "nombre": "AZUCAR GLASS"
              },
              {
                "id": 692,
                "nombre": "TARRINA DE NATA"
              },
              {
                "id": 927,
                "nombre": "BANDEJA N2"
              },
              {
                "id": 927,
                "nombre": "BANDEJA N4"
              },
              {
                "id": 927,
                "nombre": "BANDEJA N6"
              },
              {
                "id": 927,
                "nombre": "BANDEJA N8"
              },
              {
                "id": 927,
                "nombre": "BANDEJA N10"
              },
              {
                "id": 927,
                "nombre": "BANDEJA N12"
              },
              {
                "id": 953,
                "nombre": "BOLSA ASA "
              },
              {
                "id": 954,
                "nombre": "BOLSA BOLLERIA PEQUEÑA"
              },
              {
                "id": 954,
                "nombre": "BOLSA BOLLERIA GRANDE"
              },
              {
                "id": 954,
                "nombre": "BOLSA BOLLERIA TRANSPARENTE"
              },
              {
                "id": 956,
                "nombre": "CAJA"
              },
              {
                "id": 1053,
                "nombre": "GAZPACHO BOLSA GERO"
              },
              {
                "id": 1054,
                "nombre": "TORTA GAZPACHO GERO"
              },
              {
                "id": 1061,
                "nombre": "HUEVOS CAMPEROS "
              },
              {
                "id": 1133,
                "nombre": "CHOCOLATE EN POLVO PECA"
              },
              {
                "id": 1193,
                "nombre": "MIX VEGETAL"
              }
            ]
          },
          {
            "nombre": "MANTECADOS DE NAVIDAD",
            "productos": [
              {
                "id": 43,
                "nombre": "MANTECADOS"
              },
              {
                "id": 322,
                "nombre": "SUSPIROS"
              },
              {
                "id": 323,
                "nombre": "MARQUESITAS"
              },
              {
                "id": 336,
                "nombre": "ESTUCHES DE MANTECADOS"
              },
              {
                "id": 337,
                "nombre": "VOULAVENT PEQUEÑO"
              },
              {
                "id": 338,
                "nombre": "VOULAVENT MEDIANO"
              },
              {
                "id": 339,
                "nombre": "VOLAVENT GRANDE"
              },
              {
                "id": 340,
                "nombre": "VOLAVENT DOCENA PEQUEÑO"
              },
              {
                "id": 672,
                "nombre": "REYES MAGOS"
              },
              {
                "id": 690,
                "nombre": "SACOS DE CARBON"
              },
              {
                "id": 865,
                "nombre": "FRUTAS DE ARAGON"
              },
              {
                "id": 866,
                "nombre": "MAZAPAN"
              },
              {
                "id": 868,
                "nombre": "EMPIÑONADOS SIN AZUCAR"
              },
              {
                "id": 869,
                "nombre": "TURRON SIN AZUCAR"
              },
              {
                "id": 1033,
                "nombre": "POLVORON ALMENDRA"
              },
              {
                "id": 1040,
                "nombre": "ESTUCHE DE MANTECADOS PEQUEÑO"
              },
              {
                "id": 1041,
                "nombre": "VOULOVANT RELLENO PESO"
              }
            ]
          },
          {
            "nombre": "ROSCONES",
            "productos": [
              {
                "id": 342,
                "nombre": "ROSCON 12-14 RACIONES NORMAL"
              },
              {
                "id": 343,
                "nombre": "ROSCON 12-14 RACIONES RELLENO NATA"
              },
              {
                "id": 344,
                "nombre": "ROSCON 8 RACIONES RELLENO NATA"
              },
              {
                "id": 345,
                "nombre": "ROSCON 8 RACIONES NORMAL"
              },
              {
                "id": 346,
                "nombre": "ROSCON 8 RACIONES MIXTO"
              },
              {
                "id": 347,
                "nombre": "ROSCON 12 - 14 RACIONES MIXTO"
              },
              {
                "id": 348,
                "nombre": "ROSCON ESPECIAL NORMAL"
              },
              {
                "id": 349,
                "nombre": "ROSCON ESPECIAL RELLENO NATA"
              },
              {
                "id": 350,
                "nombre": "ROSCON ESPECIAL MIXTO"
              },
              {
                "id": 695,
                "nombre": "ROSCON SIN AZUCAR NORMAL"
              },
              {
                "id": 929,
                "nombre": "ROSCON 8 RACIONES RELLENO CREMA"
              },
              {
                "id": 930,
                "nombre": "ROSCON 8 RACIONES RELLENO TRUFA"
              },
              {
                "id": 931,
                "nombre": "ROSCON 8 RACIONES RELLENO CABELLO"
              },
              {
                "id": 932,
                "nombre": "ROSCON 12-14 RACIONES RELLENO TRUFA"
              },
              {
                "id": 933,
                "nombre": "ROSCON 12-14 RACIONES RELLENO CREMA"
              },
              {
                "id": 934,
                "nombre": "ROSCON 12-14 RACIONES RELLENO CABELLO"
              },
              {
                "id": 935,
                "nombre": "ROSCON ESPECIAL RELLENO TRUFA"
              },
              {
                "id": 936,
                "nombre": "ROSCON ESPECIAL RELLENO CREMA"
              },
              {
                "id": 937,
                "nombre": "ROSCON ESPECIAL RELLENO CABELLO"
              },
              {
                "id": 938,
                "nombre": "ROSCONCITO NORMAL"
              },
              {
                "id": 939,
                "nombre": "ROSCONCITO RELLENO NATA"
              },
              {
                "id": 940,
                "nombre": "ROSCONCITO RELLENO TRUFA"
              },
              {
                "id": 1141,
                "nombre": "ROSCON SIN AZUCAR RELLENO NATA O TRUFA"
              },
              {
                "id": 1142,
                "nombre": "ROSCON 8 RACIONES RELLENO TURRON"
              },
              {
                "id": 1175,
                "nombre": "ROSCONCITO TURRON"
              }
            ]
          },
          {
            "nombre": "MONAS",
            "productos": [
              {
                "id": 382,
                "nombre": "MONA NORMAL"
              },
              {
                "id": 383,
                "nombre": "MONAS LAGARTO"
              },
              {
                "id": 384,
                "nombre": "MONAS PEQUEÑAS"
              },
              {
                "id": 386,
                "nombre": "MONAS CHOCO NEGRO"
              },
              {
                "id": 387,
                "nombre": "MONAS CHOCO BLANCO"
              },
              {
                "id": 388,
                "nombre": "HORNAZOS"
              },
              {
                "id": 404,
                "nombre": "HORNAZO CON 2 CHORIZOS"
              },
              {
                "id": 874,
                "nombre": "MONA HUEVO DE COLORES"
              },
              {
                "id": 890,
                "nombre": "MINI HORNAZO"
              },
              {
                "id": 947,
                "nombre": "MONA RELLENA DE CHOCOLATE"
              },
              {
                "id": 948,
                "nombre": "MONA SIN AZUCAR"
              },
              {
                "id": 1150,
                "nombre": "MONA RELLENA KINDER"
              }
            ]
          }
        ]';

        $productos = [];
        
        $productos = json_decode($productos_json, true);

        for ($i = 0; $i < count($productos); $i++) {

            for ($j = 0; $j < count($productos[$i]["productos"]); $j++) {

                $producto = new Product();
                $producto->name = ucfirst(mb_strtolower($productos[$i]["productos"][$j]["nombre"]));
                $producto->reference = $productos[$i]["productos"][$j]["id"];
                $producto->activo = true;
                $producto->category_id = Category::where('name', $productos[$i]["nombre"])->first()->id;
                $producto->save();
            }
        }
    
    
    }


}
