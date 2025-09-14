<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attraction;

class AttractionSeeder extends Seeder
{
    public function run()
    {
        $attractions = [
            ['name' => 'Playa Capachica', 'type' => 'Playa', 'description' => 'Hermosa playa con aguas cristalinas.', 'latitude' => -15.8301, 'longitude' => -69.2234],
            ['name' => 'Sitio Arqueológico Capachica', 'type' => 'Sitio Arqueológico', 'description' => 'Restos preincaicos interesantes.', 'latitude' => -15.8320, 'longitude' => -69.2200],
            ['name' => 'Playa Puno', 'type' => 'Playa', 'description' => 'Playa amplia y tranquila.', 'latitude' => -15.8400, 'longitude' => -69.2100],
            ['name' => 'Museo Juli', 'type' => 'Museo', 'description' => 'Exhibición arqueológica.', 'latitude' => -15.8500, 'longitude' => -69.2000],
            ['name' => 'Parque Nacional Bahuaja', 'type' => 'Parque Natural', 'description' => 'Ecosistemas protegidos.', 'latitude' => -15.8600, 'longitude' => -69.1900],
            ['name' => 'Laguna Huaypo', 'type' => 'Laguna', 'description' => 'Actividades acuáticas.', 'latitude' => -15.8700, 'longitude' => -69.1800],
            ['name' => 'Cañón Colca', 'type' => 'Cañón', 'description' => 'Cañón profundo y bello.', 'latitude' => -15.8800, 'longitude' => -69.1700],
            ['name' => 'Plaza Capachica', 'type' => 'Lugar Histórico', 'description' => 'Centro cultural.', 'latitude' => -15.8900, 'longitude' => -69.1600],
            ['name' => 'Mirador Andes', 'type' => 'Mirador', 'description' => 'Vistas espectaculares.', 'latitude' => -15.8950, 'longitude' => -69.1500],
            ['name' => 'Reserva Titicaca', 'type' => 'Reserva Natural', 'description' => 'Protección de ecosistemas.', 'latitude' => -15.9000, 'longitude' => -69.1400],
            ['name' => 'Catarata Inca', 'type' => 'Cascada', 'description' => 'Cascada impresionante.', 'latitude' => -15.9100, 'longitude' => -69.1300],
            ['name' => 'Playa Anexo', 'type' => 'Playa', 'description' => 'Pequeña playa aislada.', 'latitude' => -15.9200, 'longitude' => -69.1200],
            ['name' => 'Museo Regional', 'type' => 'Museo', 'description' => 'Arte regional.', 'latitude' => -15.9300, 'longitude' => -69.1100],
            ['name' => 'Parque Botánico', 'type' => 'Parque Natural', 'description' => 'Flora local.', 'latitude' => -15.9400, 'longitude' => -69.1000],
            ['name' => 'Laguna Azul', 'type' => 'Laguna', 'description' => 'Aguas cristalinas.', 'latitude' => -15.9500, 'longitude' => -69.0900],
            ['name' => 'Cañón Verde', 'type' => 'Cañón', 'description' => 'Cañón rodeado de vegetación.', 'latitude' => -15.9600, 'longitude' => -69.0800],
            ['name' => 'Ruinas Antiguas', 'type' => 'Sitio Arqueológico', 'description' => 'Ruinas históricas.', 'latitude' => -15.9700, 'longitude' => -69.0700],
            ['name' => 'Plaza Central', 'type' => 'Lugar Histórico', 'description' => 'Centro de actividades.', 'latitude' => -15.9800, 'longitude' => -69.0600],
            ['name' => 'Mirador del Lago', 'type' => 'Mirador', 'description' => 'Vista panorámica del lago.', 'latitude' => -15.9850, 'longitude' => -69.0550],
            ['name' => 'Reserva Natural Los Andes', 'type' => 'Reserva Natural', 'description' => 'Diversidad biológica.', 'latitude' => -15.9900, 'longitude' => -69.0500],
            ['name' => 'Cascada de Oro', 'type' => 'Cascada', 'description' => 'Cascada con agua clara.', 'latitude' => -15.9950, 'longitude' => -69.0450],
            ['name' => 'Playa Serena', 'type' => 'Playa', 'description' => 'Playa tranquila y serena.', 'latitude' => -16.0000, 'longitude' => -69.0400],
            ['name' => 'Museo de Historia', 'type' => 'Museo', 'description' => 'Historia local.', 'latitude' => -16.0050, 'longitude' => -69.0350],
            ['name' => 'Parque Natural El Sol', 'type' => 'Parque Natural', 'description' => 'Naturaleza en estado puro.', 'latitude' => -16.0100, 'longitude' => -69.0300],
            ['name' => 'Laguna Cristal', 'type' => 'Laguna', 'description' => 'Lugar para relajarse.', 'latitude' => -16.0150, 'longitude' => -69.0250],
            ['name' => 'Cañón Azul', 'type' => 'Cañón', 'description' => 'Impresionantes formaciones rocosas.', 'latitude' => -16.0200, 'longitude' => -69.0200],
            ['name' => 'Ruinas Mayas', 'type' => 'Sitio Arqueológico', 'description' => 'Ruinas antiguas.', 'latitude' => -16.0250, 'longitude' => -69.0150],
            ['name' => 'Plaza Mayor', 'type' => 'Lugar Histórico', 'description' => 'Centro de la ciudad.', 'latitude' => -16.0300, 'longitude' => -69.0100],
            ['name' => 'Mirador del Sol', 'type' => 'Mirador', 'description' => 'Vistas del amanecer.', 'latitude' => -16.0350, 'longitude' => -69.0050],
            ['name' => 'Reserva Natural Laguna', 'type' => 'Reserva Natural', 'description' => 'Área protegida.', 'latitude' => -16.0400, 'longitude' => -69.0000],
            ['name' => 'Cascada de Plata', 'type' => 'Cascada', 'description' => 'Cascada de agua pura.', 'latitude' => -16.0450, 'longitude' => -68.9950],
            ['name' => 'Playa Blanca', 'type' => 'Playa', 'description' => 'Arena blanca y fina.', 'latitude' => -16.0500, 'longitude' => -68.9900],
            ['name' => 'Museo de Arte', 'type' => 'Museo', 'description' => 'Colección de arte.', 'latitude' => -16.0550, 'longitude' => -68.9850],
            ['name' => 'Parque Natural Verde', 'type' => 'Parque Natural', 'description' => 'Bosques y senderos.', 'latitude' => -16.0600, 'longitude' => -68.9800],
            ['name' => 'Laguna Verde', 'type' => 'Laguna', 'description' => 'Paisajes naturales.', 'latitude' => -16.0650, 'longitude' => -68.9750],
            ['name' => 'Cañón Rojo', 'type' => 'Cañón', 'description' => 'Rocas rojas impresionantes.', 'latitude' => -16.0700, 'longitude' => -68.9700],
            ['name' => 'Ruinas Antiguas II', 'type' => 'Sitio Arqueológico', 'description' => 'Sitio arqueológico importante.', 'latitude' => -16.0750, 'longitude' => -68.9650],
            ['name' => 'Plaza Antigua', 'type' => 'Lugar Histórico', 'description' => 'Plaza histórica.', 'latitude' => -16.0800, 'longitude' => -68.9600],
            ['name' => 'Mirador Estrella', 'type' => 'Mirador', 'description' => 'Perfecto para ver estrellas.', 'latitude' => -16.0850, 'longitude' => -68.9550],
            ['name' => 'Reserva Natural Estrella', 'type' => 'Reserva Natural', 'description' => 'Zona protegida natural.', 'latitude' => -16.0900, 'longitude' => -68.9500],
            ['name' => 'Cascada Esmeralda', 'type' => 'Cascada', 'description' => 'Cascada en bosque.', 'latitude' => -16.0950, 'longitude' => -68.9450],
            ['name' => 'Playa Dorada', 'type' => 'Playa', 'description' => 'Arena dorada brillante.', 'latitude' => -16.1000, 'longitude' => -68.9400],
            ['name' => 'Museo Nacional', 'type' => 'Museo', 'description' => 'Museo histórico.', 'latitude' => -16.1050, 'longitude' => -68.9350],
            ['name' => 'Parque Nacional Verde', 'type' => 'Parque Natural', 'description' => 'Naturaleza virgen.', 'latitude' => -16.1100, 'longitude' => -68.9300],
            ['name' => 'Laguna Dorada', 'type' => 'Laguna', 'description' => 'Paisajes dorados.', 'latitude' => -16.1150, 'longitude' => -68.9250],
            ['name' => 'Cañón de Fuego', 'type' => 'Cañón', 'description' => 'Formaciones rocosas calientes.', 'latitude' => -16.1200, 'longitude' => -68.9200],
            ['name' => 'Ruinas Fuego', 'type' => 'Sitio Arqueológico', 'description' => 'Ruinas con historia.', 'latitude' => -16.1250, 'longitude' => -68.9150],
            ['name' => 'Plaza de la Luna', 'type' => 'Lugar Histórico', 'description' => 'Plaza tranquila.', 'latitude' => -16.1300, 'longitude' => -68.9100],
            ['name' => 'Mirador Luna', 'type' => 'Mirador', 'description' => 'Vistas de la luna.', 'latitude' => -16.1350, 'longitude' => -68.9050],
            ['name' => 'Reserva Natural Luna', 'type' => 'Reserva Natural', 'description' => 'Área natural protegida.', 'latitude' => -16.1400, 'longitude' => -68.9000],
        ];

        foreach ($attractions as $attraction) {
            Attraction::create($attraction);
        }
    }
}
