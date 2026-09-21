-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.4.3 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para sipeip
CREATE DATABASE IF NOT EXISTS `sipeip` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sipeip`;

-- Volcando estructura para tabla sipeip.cache
DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.cache: ~0 rows (aproximadamente)

-- Volcando estructura para tabla sipeip.cache_locks
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.cache_locks: ~0 rows (aproximadamente)

-- Volcando estructura para tabla sipeip.entidades
DROP TABLE IF EXISTS `entidades`;
CREATE TABLE IF NOT EXISTS `entidades` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `codigoInstitucional` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruc` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `siglas` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoEntidad` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nivelGobierno` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provincia` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `canton` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parroquia` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correoInstitucional` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `entidades_codigoinstitucional_unique` (`codigoInstitucional`),
  UNIQUE KEY `entidades_ruc_unique` (`ruc`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.entidades: ~5 rows (aproximadamente)
INSERT INTO `entidades` (`id`, `codigoInstitucional`, `ruc`, `nombre`, `siglas`, `tipoEntidad`, `nivelGobierno`, `provincia`, `canton`, `parroquia`, `direccion`, `telefono`, `correoInstitucional`, `estado`, `created_at`, `updated_at`) VALUES
	(1, 'SNP', '1760001200001', 'Secretaría Nacional de Planificación', 'SNP', 'Secretaría Nacional', 'Gobierno Central', 'Pichincha', 'Quito', 'Iñaquito', 'Av. Patria y Av. 12 de Octubre', '(02) 397-8900', 'info@planificacion.gob.ec', 'Activo', '2026-08-25 07:25:22', '2026-08-25 07:25:22'),
	(2, 'MTOP', '1760005600001', 'Ministerio de Transporte y Obras Públicas', 'MTOP', 'Ministerio', 'Gobierno Central', 'Pichincha', 'Quito', 'Iñaquito', 'Juan León Mera N26-220 y Av. Orellana', '(02) 397-4600', 'info@mtop.gob.ec', 'Activo', '2026-08-25 07:25:22', '2026-08-26 05:43:25'),
	(3, 'MSP', '1760005000001', 'Ministerio de Salud Pública', 'MSP', 'Ministerio', 'Gobierno Central', 'Pichincha', 'Quito', 'Itchimbía', 'Av. Quitumbe Ñan y Av. Amaru Ñan', '(02) 381-4400', 'info@salud.gob.ec', 'Activo', '2026-08-25 07:25:22', '2026-09-15 06:20:14'),
	(4, 'MINEDUC', '1760007000001', 'Ministerio de Educación', 'MINEDUC', 'Ministerio', 'Gobierno Central', 'Pichincha', 'Quito', 'Iñaquito', 'Av. Amazonas N34-451', '(02) 396-1300', 'info@educacion.gob.ec', 'Activo', '2026-08-25 07:25:22', '2026-08-25 07:25:22'),
	(5, 'GADDMQ', '1760003410001', 'Gobierno Autónomo Descentralizado del Distrito Metropolitano de Quito', 'GADDMQ', 'Gobierno Autónomo Descentralizado', 'Municipal', 'Pichincha', 'Quito', 'Centro Histórico', 'Venezuela y Chile', '(02) 395-2300', 'info@quito.gob.ec', 'Activo', '2026-08-25 07:25:22', '2026-08-25 07:25:22');

-- Volcando estructura para tabla sipeip.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.failed_jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla sipeip.indicadores
DROP TABLE IF EXISTS `indicadores`;
CREATE TABLE IF NOT EXISTS `indicadores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `meta_id` bigint unsigned NOT NULL,
  `codigo` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `formula` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `unidad_medida` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `frecuencia` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `responsable_id` bigint unsigned NOT NULL,
  `estado` enum('Activo','Inactivo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activo',
  `usuario_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indicadores_codigo_unique` (`codigo`),
  KEY `indicadores_meta_id_foreign` (`meta_id`),
  KEY `indicadores_responsable_id_foreign` (`responsable_id`),
  KEY `indicadores_usuario_id_foreign` (`usuario_id`),
  CONSTRAINT `indicadores_meta_id_foreign` FOREIGN KEY (`meta_id`) REFERENCES `metas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `indicadores_responsable_id_foreign` FOREIGN KEY (`responsable_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `indicadores_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.indicadores: ~3 rows (aproximadamente)
INSERT INTO `indicadores` (`id`, `meta_id`, `codigo`, `nombre`, `tipo`, `formula`, `unidad_medida`, `frecuencia`, `responsable_id`, `estado`, `usuario_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 'IND-01', 'indicador de prueba editado', 'Impacto', 'indicador de prueba editado', 'Horas', 'Semestral', 4, 'Activo', 5, '2026-09-17 17:44:51', '2026-09-17 17:45:46'),
	(2, 5, 'IND-02', 'prueba completa planificacion', 'Resultado', 'prueba completa', 'Minutos', 'Bimestral', 8, 'Activo', 5, '2026-09-17 20:25:00', '2026-09-17 20:25:00'),
	(3, 5, 'IND-03', 'prueba completa planificacion', 'Gestión', 'prueba completa planificacion', 'Días', 'Bimestral', 3, 'Activo', 5, '2026-09-17 20:25:26', '2026-09-17 20:25:26');

-- Volcando estructura para tabla sipeip.jobs
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla sipeip.job_batches
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.job_batches: ~0 rows (aproximadamente)

-- Volcando estructura para tabla sipeip.macrosectores
DROP TABLE IF EXISTS `macrosectores`;
CREATE TABLE IF NOT EXISTS `macrosectores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `macrosectores_nombre_unique` (`nombre`),
  KEY `macrosectores_estado_index` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.macrosectores: ~8 rows (aproximadamente)
INSERT INTO `macrosectores` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
	(1, 'Social', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(2, 'Sectores Estratégicos', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(3, 'Fomento a la Producción', 'Activo', '2026-09-19 05:16:54', '2026-09-19 06:48:54'),
	(4, 'Multisectorial', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(5, 'Seguridad', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(6, 'Talento Humano', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(7, 'prueba de registrar macro sector', 'Inactivo', '2026-09-19 06:47:32', '2026-09-19 06:48:32'),
	(8, 'prueba 2 macrosector edit', 'Inactivo', '2026-09-19 06:59:37', '2026-09-19 07:07:17');

-- Volcando estructura para tabla sipeip.metas
DROP TABLE IF EXISTS `metas`;
CREATE TABLE IF NOT EXISTS `metas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `objetivo_id` bigint unsigned NOT NULL,
  `codigo` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `linea_base` decimal(10,2) NOT NULL,
  `valor_meta` decimal(10,2) NOT NULL,
  `unidad_medida` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periodo_inicio` year NOT NULL,
  `periodo_fin` year NOT NULL,
  `responsable_id` bigint unsigned NOT NULL,
  `estado` enum('Activo','Inactivo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activo',
  `usuario_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `metas_codigo_unique` (`codigo`),
  KEY `metas_objetivo_id_foreign` (`objetivo_id`),
  KEY `metas_responsable_id_foreign` (`responsable_id`),
  KEY `metas_usuario_id_foreign` (`usuario_id`),
  CONSTRAINT `metas_objetivo_id_foreign` FOREIGN KEY (`objetivo_id`) REFERENCES `objetivos` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `metas_responsable_id_foreign` FOREIGN KEY (`responsable_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `metas_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.metas: ~5 rows (aproximadamente)
INSERT INTO `metas` (`id`, `objetivo_id`, `codigo`, `nombre`, `descripcion`, `linea_base`, `valor_meta`, `unidad_medida`, `periodo_inicio`, `periodo_fin`, `responsable_id`, `estado`, `usuario_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 'META-01', 'prueba editada', 'prueba editada', 0.10, 0.10, 'Personas', '2005', '2006', 5, 'Activo', 5, '2026-09-17 07:54:20', '2026-09-17 17:43:58'),
	(2, 1, 'META-02', 'PRUEBA 2', 'prueba 2', 213.00, 123.00, 'Años', '2000', '2001', 6, 'Activo', 5, '2026-09-17 17:56:37', '2026-09-17 17:56:37'),
	(3, 1, 'META-03', 'Fortalecer la infraestructura vial nacional mediante una planificación eficiente y sostenible.', 'sadadsad', 234.00, 233.95, 'Minutos', '2001', '2001', 6, 'Activo', 5, '2026-09-17 18:00:55', '2026-09-17 18:00:55'),
	(4, 8, 'META-04', 'prueba completa planificacion', 'prueba completa planificacion', 0.03, 0.04, 'Capacitaciones', '2002', '2019', 8, 'Activo', 5, '2026-09-17 20:22:47', '2026-09-17 20:22:47'),
	(5, 8, 'META-05', 'prueba completa planificacion', 'prueba completa', 0.03, 0.04, 'Años', '2000', '2001', 8, 'Activo', 5, '2026-09-17 20:23:53', '2026-09-17 20:23:53');

-- Volcando estructura para tabla sipeip.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.migrations: ~31 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_06_16_004850_create_entidades_table', 1),
	(5, '2026_06_16_012547_create_roles_table', 1),
	(6, '2026_06_16_024951_update_users_table', 1),
	(7, '2026_06_27_043053_create_planes_table', 1),
	(8, '2026_07_01_171100_create_ods_table', 1),
	(9, '2026_07_01_171200_create_objetivos_table', 1),
	(10, '2026_07_01_171923_create_metas_table', 1),
	(11, '2026_07_10_122644_create_indicadores_table', 1),
	(12, '2026_07_16_130325_create_ods_metas_table', 1),
	(13, '2026_07_17_025453_create_programas_table', 1),
	(14, '2026_07_17_025515_create_programa_objetivo_table', 1),
	(15, '2026_07_17_113203_create_proyectos_table', 1),
	(16, '2026_08_18_010345_add_codigo_to_roles_table', 1),
	(17, '2026_08_18_011613_assign_codes_to_existing_roles', 1),
	(18, '2026_08_18_123723_make_entidad_id_nullable_in_users_table', 1),
	(19, '2026_08_18_173504_add_asignable_institucion_to_roles_table', 1),
	(20, '2026_08_22_124004_create_pnd_table', 1),
	(21, '2026_08_22_124048_create_pnd_ejes_table', 1),
	(22, '2026_08_22_124109_create_pnd_objetivos_table', 1),
	(23, '2026_08_22_124127_create_pnd_politicas_table', 1),
	(24, '2026_08_22_124146_create_pnd_estrategias_table', 1),
	(25, '2026_08_22_124205_create_pnd_metas_table', 1),
	(26, '2026_08_22_125942_remove_estado_from_pnd_structure_tables', 1),
	(27, '2026_08_25_011633_add_estado_proceso_and_version_to_planes_table', 1),
	(28, '2026_09_16_233142_add_catalog_relations_to_objetivos_table', 2),
	(29, '2026_09_19_000439_create_macrosectores_table', 3),
	(30, '2026_09_19_000449_create_sectores_table', 3),
	(31, '2026_09_19_000456_create_subsectores_table', 3),
	(32, '2026_09_19_022907_add_institutional_fields_to_programas_table', 4),
	(33, '2026_09_19_023006_add_unique_constraint_to_programa_objetivo_table', 4),
	(34, '2026_09_19_035906_add_institutional_fields_to_proyectos_table', 5),
	(35, '2026_09_21_000001_create_avances_table', 6),
	(36, '2026_09_21_000002_create_presupuestos_table', 6);

-- Volcando estructura para tabla sipeip.objetivos
DROP TABLE IF EXISTS `objetivos`;
CREATE TABLE IF NOT EXISTS `objetivos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` bigint unsigned NOT NULL,
  `pnd_id` bigint unsigned NOT NULL,
  `pnd_politica_id` bigint unsigned DEFAULT NULL,
  `ods_id` bigint unsigned NOT NULL,
  `ods_meta_id` bigint unsigned DEFAULT NULL,
  `codigo` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `estado` enum('Activo','Inactivo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activo',
  `usuario_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `objetivos_codigo_unique` (`codigo`),
  KEY `objetivos_plan_id_foreign` (`plan_id`),
  KEY `objetivos_ods_id_foreign` (`ods_id`),
  KEY `objetivos_usuario_id_foreign` (`usuario_id`),
  KEY `objetivos_pnd_politica_id_foreign` (`pnd_politica_id`),
  KEY `objetivos_ods_meta_id_foreign` (`ods_meta_id`),
  CONSTRAINT `objetivos_ods_id_foreign` FOREIGN KEY (`ods_id`) REFERENCES `ods` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `objetivos_ods_meta_id_foreign` FOREIGN KEY (`ods_meta_id`) REFERENCES `ods_metas` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `objetivos_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `planes` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `objetivos_pnd_politica_id_foreign` FOREIGN KEY (`pnd_politica_id`) REFERENCES `pnd_politicas` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `objetivos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.objetivos: ~7 rows (aproximadamente)
INSERT INTO `objetivos` (`id`, `plan_id`, `pnd_id`, `pnd_politica_id`, `ods_id`, `ods_meta_id`, `codigo`, `nombre`, `descripcion`, `estado`, `usuario_id`, `created_at`, `updated_at`) VALUES
	(1, 4, 1, 1, 1, 1, 'OEI-01', 'prueba', 'dsfdsfdsfsdf', 'Activo', 5, '2026-09-17 05:04:27', '2026-09-17 05:08:45'),
	(2, 4, 2, 13, 14, 123, 'OEI-02', 'prueba 2', 'sadsadsad', 'Activo', 5, '2026-09-17 19:03:46', '2026-09-17 19:03:46'),
	(3, 4, 2, 15, 13, 114, 'OEI-03', 'PRUEBA 3', 'dsfdsfdsf', 'Activo', 5, '2026-09-17 19:08:31', '2026-09-17 19:08:31'),
	(4, 5, 2, 13, 13, 114, 'OEI-04', 'computador', 'computador', 'Activo', 5, '2026-09-17 19:40:01', '2026-09-17 19:40:01'),
	(5, 5, 5, 46, 15, 134, 'OEI-05', 'pc2', 'pc2', 'Activo', 5, '2026-09-17 19:58:34', '2026-09-17 19:58:34'),
	(6, 1, 3, 23, 12, 107, 'OEI-06', 'pc2', 'pc2', 'Activo', 5, '2026-09-17 19:58:48', '2026-09-17 19:58:48'),
	(7, 1, 2, 11, 15, 134, 'OEI-07', 'dsfdfsdfsdfdsfdsfdsfsdfsdfsdfsdffsdfsdfsdfsdf', 'dsfdfsdfsdfdsfdsfdsfsdfsdfsdfsdffsdfsdfsdfsdf', 'Activo', 5, '2026-09-17 19:59:46', '2026-09-17 19:59:46'),
	(8, 7, 1, 10, 14, 124, 'OEI-08', 'prueba completa planificacion', 'prueba completa', 'Activo', 5, '2026-09-17 20:20:32', '2026-09-17 20:20:32');

-- Volcando estructura para tabla sipeip.ods
DROP TABLE IF EXISTS `ods`;
CREATE TABLE IF NOT EXISTS `ods` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` enum('Activo','Inactivo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ods_codigo_unique` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.ods: ~17 rows (aproximadamente)
INSERT INTO `ods` (`id`, `codigo`, `nombre`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
	(1, 'ODS-01', 'Fin de la pobreza', 'Poner fin a la pobreza en todas sus formas y en todo el mundo.', 'Activo', '2026-08-25 07:25:25', '2026-08-25 07:25:25'),
	(2, 'ODS-02', 'Hambre cero', 'Poner fin al hambre, lograr la seguridad alimentaria y promover la agricultura sostenible.', 'Activo', '2026-08-25 07:25:25', '2026-08-25 07:25:25'),
	(3, 'ODS-03', 'Salud y bienestar', 'Garantizar una vida sana y promover el bienestar para todas las personas en todas las edades.', 'Activo', '2026-08-25 07:25:25', '2026-08-25 07:25:25'),
	(4, 'ODS-04', 'Educación de calidad', 'Garantizar una educación inclusiva, equitativa y de calidad y promover oportunidades de aprendizaje durante toda la vida.', 'Activo', '2026-08-25 07:25:25', '2026-08-25 07:25:25'),
	(5, 'ODS-05', 'Igualdad de género', 'Lograr la igualdad entre los géneros y empoderar a todas las mujeres y las niñas.', 'Activo', '2026-08-25 07:25:25', '2026-08-25 07:25:25'),
	(6, 'ODS-06', 'Agua limpia y saneamiento', 'Garantizar la disponibilidad de agua, su gestión sostenible y el saneamiento para todos.', 'Activo', '2026-08-25 07:25:25', '2026-08-25 07:25:25'),
	(7, 'ODS-07', 'Energía asequible y no contaminante', 'Garantizar el acceso a una energía asequible, fiable, sostenible y moderna para todos.', 'Activo', '2026-08-25 07:25:25', '2026-08-25 07:25:25'),
	(8, 'ODS-08', 'Trabajo decente y crecimiento económico', 'Promover el crecimiento económico sostenido, inclusivo y sostenible, el empleo pleno y productivo y el trabajo decente para todos.', 'Activo', '2026-08-25 07:25:25', '2026-08-25 07:25:25'),
	(9, 'ODS-09', 'Industria, innovación e infraestructura', 'Construir infraestructuras resilientes, promover la industrialización sostenible y fomentar la innovación.', 'Activo', '2026-08-25 07:25:25', '2026-08-25 07:25:25'),
	(10, 'ODS-10', 'Reducción de las desigualdades', 'Reducir la desigualdad en y entre los países.', 'Activo', '2026-08-25 07:25:25', '2026-08-25 07:25:25'),
	(11, 'ODS-11', 'Ciudades y comunidades sostenibles', 'Lograr que las ciudades y los asentamientos humanos sean inclusivos, seguros, resilientes y sostenibles.', 'Activo', '2026-08-25 07:25:25', '2026-08-25 07:25:25'),
	(12, 'ODS-12', 'Producción y consumo responsables', 'Garantizar modalidades de consumo y producción sostenibles.', 'Activo', '2026-08-25 07:25:25', '2026-08-25 07:25:25'),
	(13, 'ODS-13', 'Acción por el clima', 'Adoptar medidas urgentes para combatir el cambio climático y sus efectos.', 'Activo', '2026-08-25 07:25:25', '2026-08-25 07:25:25'),
	(14, 'ODS-14', 'Vida submarina', 'Conservar y utilizar sosteniblemente los océanos, los mares y los recursos marinos.', 'Activo', '2026-08-25 07:25:25', '2026-08-25 07:25:25'),
	(15, 'ODS-15', 'Vida de ecosistemas terrestres', 'Gestionar sosteniblemente los bosques, luchar contra la desertificación y detener la pérdida de biodiversidad.', 'Activo', '2026-08-25 07:25:25', '2026-08-25 07:25:25'),
	(16, 'ODS-16', 'Paz, justicia e instituciones sólidas', 'Promover sociedades pacíficas e inclusivas, facilitar el acceso a la justicia y construir instituciones eficaces.', 'Activo', '2026-08-25 07:25:25', '2026-08-25 07:25:25'),
	(17, 'ODS-17', 'Alianzas para lograr los objetivos', 'Fortalecer los medios de implementación y revitalizar la Alianza Mundial para el Desarrollo Sostenible.', 'Activo', '2026-08-25 07:25:25', '2026-08-25 07:25:25');

-- Volcando estructura para tabla sipeip.ods_metas
DROP TABLE IF EXISTS `ods_metas`;
CREATE TABLE IF NOT EXISTS `ods_metas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ods_id` bigint unsigned NOT NULL,
  `codigo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `estado` enum('Activo','Inactivo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ods_metas_ods_id_foreign` (`ods_id`),
  CONSTRAINT `ods_metas_ods_id_foreign` FOREIGN KEY (`ods_id`) REFERENCES `ods` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.ods_metas: ~169 rows (aproximadamente)
INSERT INTO `ods_metas` (`id`, `ods_id`, `codigo`, `nombre`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
	(1, 1, '1.1', 'Erradicar la pobreza extrema', 'Para 2030, erradicar para todas las personas y en todo el mundo la pobreza extrema, actualmente medida por un ingreso por persona inferior a 2,15 dólares de los Estados Unidos al día.', 'Activo', '2026-07-16 11:48:23', '2026-07-16 11:48:23'),
	(2, 1, '1.2', 'Reducir la pobreza en todas sus dimensiones', 'Para 2030, reducir al menos a la mitad la proporción de hombres, mujeres y niños de todas las edades que viven en la pobreza en todas sus dimensiones con arreglo a las definiciones nacionales.', 'Activo', '2026-07-16 11:48:23', '2026-07-16 11:48:23'),
	(3, 1, '1.3', 'Implementar sistemas de protección social', 'Implementar a nivel nacional sistemas y medidas apropiados de protección social para todos y, para 2030, lograr una amplia cobertura de las personas pobres y vulnerables.', 'Activo', '2026-07-16 11:48:23', '2026-07-16 11:48:23'),
	(4, 1, '1.4', 'Garantizar igualdad de acceso a los recursos y servicios', 'Para 2030, garantizar que todos los hombres y mujeres, en particular las personas pobres y vulnerables, tengan los mismos derechos a los recursos económicos y acceso a los servicios básicos, la propiedad, los recursos naturales, las nuevas tecnologías apropiadas y los servicios financieros, incluida la microfinanciación.', 'Activo', '2026-07-16 11:48:23', '2026-07-16 11:48:23'),
	(5, 1, '1.5', 'Reducir la vulnerabilidad frente a desastres', 'Para 2030, fomentar la resiliencia de las personas pobres y de quienes se encuentran en situaciones de vulnerabilidad y reducir su exposición y vulnerabilidad a los fenómenos extremos relacionados con el clima y otras perturbaciones y desastres económicos, sociales y ambientales.', 'Activo', '2026-07-16 11:48:23', '2026-07-16 11:48:23'),
	(6, 1, '1.a', 'Movilizar recursos para erradicar la pobreza', 'Garantizar una movilización significativa de recursos procedentes de diversas fuentes, incluso mediante una mayor cooperación para el desarrollo, a fin de proporcionar medios suficientes y previsibles para que los países en desarrollo implementen programas y políticas encaminados a poner fin a la pobreza en todas sus dimensiones.', 'Activo', '2026-07-16 11:48:23', '2026-07-16 11:48:23'),
	(7, 1, '1.b', 'Crear políticas de apoyo a las personas pobres', 'Crear marcos normativos sólidos en los ámbitos nacional, regional e internacional, basados en estrategias de desarrollo favorables a las personas pobres y con perspectiva de género, para apoyar la inversión acelerada en medidas destinadas a erradicar la pobreza.', 'Activo', '2026-07-16 11:48:23', '2026-07-16 11:48:23'),
	(8, 2, '2.1', 'Poner fin al hambre', 'Para 2030, poner fin al hambre y asegurar el acceso de todas las personas, en particular las personas pobres y vulnerables, incluidos los niños menores de un año, a una alimentación sana, nutritiva y suficiente durante todo el año.', 'Activo', '2026-07-16 11:50:37', '2026-07-16 11:50:37'),
	(9, 2, '2.2', 'Poner fin a todas las formas de malnutrición', 'Para 2030, poner fin a todas las formas de malnutrición, incluso logrando las metas convenidas internacionalmente sobre el retraso del crecimiento y la emaciación de los niños menores de cinco años, y abordar las necesidades nutricionales de las adolescentes, las mujeres embarazadas y lactantes y las personas de edad.', 'Activo', '2026-07-16 11:50:37', '2026-07-16 11:50:37'),
	(10, 2, '2.3', 'Duplicar la productividad agrícola y los ingresos de los pequeños productores', 'Para 2030, duplicar la productividad agrícola y los ingresos de los productores de alimentos en pequeña escala, en particular las mujeres, los pueblos indígenas, los agricultores familiares, los ganaderos y los pescadores.', 'Activo', '2026-07-16 11:50:37', '2026-07-16 11:50:37'),
	(11, 2, '2.4', 'Garantizar sistemas sostenibles de producción de alimentos', 'Para 2030, asegurar la sostenibilidad de los sistemas de producción de alimentos y aplicar prácticas agrícolas resilientes que aumenten la productividad y la producción, contribuyan al mantenimiento de los ecosistemas y fortalezcan la capacidad de adaptación al cambio climático.', 'Activo', '2026-07-16 11:50:37', '2026-07-16 11:50:37'),
	(12, 2, '2.5', 'Mantener la diversidad genética', 'Para 2030, mantener la diversidad genética de las semillas, las plantas cultivadas y los animales de granja y domesticados y sus especies silvestres conexas.', 'Activo', '2026-07-16 11:50:37', '2026-07-16 11:50:37'),
	(13, 2, '2.a', 'Aumentar las inversiones en infraestructura rural e investigación agrícola', 'Aumentar las inversiones, incluso mediante una mayor cooperación internacional, en infraestructura rural, investigación y servicios de extensión agrícola, desarrollo tecnológico y bancos de genes de plantas y ganado.', 'Activo', '2026-07-16 11:50:37', '2026-07-16 11:50:37'),
	(14, 2, '2.b', 'Corregir y prevenir las restricciones y distorsiones comerciales', 'Corregir y prevenir las restricciones y distorsiones comerciales en los mercados agropecuarios mundiales, incluso mediante la eliminación paralela de todas las formas de subvenciones a las exportaciones agrícolas.', 'Activo', '2026-07-16 11:50:37', '2026-07-16 11:50:37'),
	(15, 2, '2.c', 'Garantizar el buen funcionamiento de los mercados de alimentos', 'Adoptar medidas para asegurar el buen funcionamiento de los mercados de productos básicos alimentarios y facilitar el acceso oportuno a información sobre los mercados para ayudar a limitar la extrema volatilidad de los precios de los alimentos.', 'Activo', '2026-07-16 11:50:37', '2026-07-16 11:50:37'),
	(16, 3, '3.1', 'Reducir la mortalidad materna', 'Para 2030, reducir la tasa mundial de mortalidad materna a menos de 70 por cada 100.000 nacidos vivos.', 'Activo', '2026-07-16 11:51:06', '2026-07-16 11:51:06'),
	(17, 3, '3.2', 'Poner fin a las muertes evitables de recién nacidos y menores de cinco años', 'Para 2030, poner fin a las muertes evitables de recién nacidos y de niños menores de cinco años.', 'Activo', '2026-07-16 11:51:06', '2026-07-16 11:51:06'),
	(18, 3, '3.3', 'Poner fin a las epidemias', 'Para 2030, poner fin a las epidemias del SIDA, la tuberculosis, la malaria y las enfermedades tropicales desatendidas, y combatir la hepatitis, las enfermedades transmitidas por el agua y otras enfermedades transmisibles.', 'Activo', '2026-07-16 11:51:06', '2026-07-16 11:51:06'),
	(19, 3, '3.4', 'Reducir la mortalidad por enfermedades no transmisibles y promover la salud mental', 'Para 2030, reducir en un tercio la mortalidad prematura por enfermedades no transmisibles mediante la prevención y el tratamiento, y promover la salud mental y el bienestar.', 'Activo', '2026-07-16 11:51:06', '2026-07-16 11:51:06'),
	(20, 3, '3.5', 'Prevenir y tratar el abuso de sustancias', 'Fortalecer la prevención y el tratamiento del abuso de sustancias adictivas, incluido el uso indebido de estupefacientes y el consumo nocivo de alcohol.', 'Activo', '2026-07-16 11:51:06', '2026-07-16 11:51:06'),
	(21, 3, '3.6', 'Reducir las muertes y lesiones por accidentes de tránsito', 'Para 2030, reducir a la mitad el número de muertes y lesiones causadas por accidentes de tráfico en el mundo.', 'Activo', '2026-07-16 11:51:06', '2026-07-16 11:51:06'),
	(22, 3, '3.7', 'Garantizar el acceso universal a la salud sexual y reproductiva', 'Para 2030, garantizar el acceso universal a los servicios de salud sexual y reproductiva, incluidos los de planificación familiar, información y educación.', 'Activo', '2026-07-16 11:51:06', '2026-07-16 11:51:06'),
	(23, 3, '3.8', 'Lograr la cobertura sanitaria universal', 'Lograr la cobertura sanitaria universal, incluida la protección contra los riesgos financieros, el acceso a servicios de salud esenciales de calidad y a medicamentos y vacunas seguros, eficaces, asequibles y de calidad para todos.', 'Activo', '2026-07-16 11:51:06', '2026-07-16 11:51:06'),
	(24, 3, '3.9', 'Reducir enfermedades y muertes por contaminación', 'Para 2030, reducir considerablemente el número de muertes y enfermedades causadas por productos químicos peligrosos y por la contaminación del aire, el agua y el suelo.', 'Activo', '2026-07-16 11:51:06', '2026-07-16 11:51:06'),
	(25, 3, '3.a', 'Aplicar el Convenio Marco de la OMS para el Control del Tabaco', 'Fortalecer la aplicación del Convenio Marco de la Organización Mundial de la Salud para el Control del Tabaco en todos los países.', 'Activo', '2026-07-16 11:51:06', '2026-07-16 11:51:06'),
	(26, 3, '3.b', 'Apoyar la investigación y el acceso a medicamentos y vacunas', 'Apoyar las actividades de investigación y desarrollo de vacunas y medicamentos para las enfermedades que afectan principalmente a los países en desarrollo, y facilitar el acceso a medicamentos y vacunas esenciales asequibles.', 'Activo', '2026-07-16 11:51:06', '2026-07-16 11:51:06'),
	(27, 3, '3.c', 'Aumentar la financiación y el personal sanitario', 'Aumentar considerablemente la financiación de la salud y la contratación, el desarrollo, la capacitación y la retención del personal sanitario en los países en desarrollo.', 'Activo', '2026-07-16 11:51:06', '2026-07-16 11:51:06'),
	(28, 3, '3.d', 'Reforzar la capacidad para la gestión de riesgos sanitarios', 'Reforzar la capacidad de todos los países, en particular los países en desarrollo, en materia de alerta temprana, reducción y gestión de los riesgos para la salud nacional y mundial.', 'Activo', '2026-07-16 11:51:06', '2026-07-16 11:51:06'),
	(29, 4, '4.1', 'Garantizar la educación primaria y secundaria gratuita', 'Para 2030, asegurar que todas las niñas y todos los niños terminen la enseñanza primaria y secundaria gratuita, equitativa y de calidad, que produzca resultados de aprendizaje pertinentes y efectivos.', 'Activo', '2026-07-16 11:51:17', '2026-07-16 11:51:17'),
	(30, 4, '4.2', 'Asegurar el acceso a la educación preescolar', 'Para 2030, asegurar que todas las niñas y todos los niños tengan acceso a servicios de atención y desarrollo en la primera infancia y educación preescolar de calidad.', 'Activo', '2026-07-16 11:51:17', '2026-07-16 11:51:17'),
	(31, 4, '4.3', 'Garantizar el acceso igualitario a la educación superior', 'Para 2030, asegurar el acceso igualitario de todos los hombres y las mujeres a una formación técnica, profesional y superior de calidad, incluida la enseñanza universitaria.', 'Activo', '2026-07-16 11:51:17', '2026-07-16 11:51:17'),
	(32, 4, '4.4', 'Aumentar las competencias para el empleo', 'Para 2030, aumentar considerablemente el número de jóvenes y adultos que tienen las competencias necesarias, en particular técnicas y profesionales, para acceder al empleo, el trabajo decente y el emprendimiento.', 'Activo', '2026-07-16 11:51:17', '2026-07-16 11:51:17'),
	(33, 4, '4.5', 'Eliminar las desigualdades en la educación', 'Para 2030, eliminar las disparidades de género en la educación y asegurar el acceso igualitario a todos los niveles de enseñanza y formación profesional para las personas vulnerables.', 'Activo', '2026-07-16 11:51:17', '2026-07-16 11:51:17'),
	(34, 4, '4.6', 'Garantizar la alfabetización y conocimientos básicos', 'Para 2030, asegurar que todos los jóvenes y una proporción considerable de los adultos, tanto hombres como mujeres, estén alfabetizados y tengan nociones elementales de aritmética.', 'Activo', '2026-07-16 11:51:17', '2026-07-16 11:51:17'),
	(35, 4, '4.7', 'Promover el desarrollo sostenible mediante la educación', 'Para 2030, asegurar que todos los alumnos adquieran los conocimientos y competencias necesarios para promover el desarrollo sostenible, los derechos humanos, la igualdad de género, la cultura de paz, la ciudadanía mundial y la valoración de la diversidad cultural.', 'Activo', '2026-07-16 11:51:17', '2026-07-16 11:51:17'),
	(36, 4, '4.a', 'Construir y mejorar instalaciones educativas', 'Construir y adecuar instalaciones educativas que tengan en cuenta las necesidades de los niños y las personas con discapacidad, las diferencias de género y que ofrezcan entornos de aprendizaje seguros, inclusivos y eficaces.', 'Activo', '2026-07-16 11:51:17', '2026-07-16 11:51:17'),
	(37, 4, '4.b', 'Aumentar las becas para países en desarrollo', 'Para 2020, aumentar considerablemente a nivel mundial el número de becas disponibles para los países en desarrollo, especialmente los menos adelantados y los pequeños Estados insulares en desarrollo.', 'Activo', '2026-07-16 11:51:17', '2026-07-16 11:51:17'),
	(38, 4, '4.c', 'Aumentar la oferta de docentes calificados', 'Para 2030, aumentar considerablemente la oferta de docentes calificados, incluso mediante la cooperación internacional para la formación de docentes en los países en desarrollo.', 'Activo', '2026-07-16 11:51:17', '2026-07-16 11:51:17'),
	(39, 5, '5.1', 'Poner fin a la discriminación contra las mujeres y las niñas', 'Poner fin a todas las formas de discriminación contra todas las mujeres y las niñas en todo el mundo.', 'Activo', '2026-07-16 11:51:57', '2026-07-16 11:51:57'),
	(40, 5, '5.2', 'Eliminar la violencia contra las mujeres y las niñas', 'Eliminar todas las formas de violencia contra todas las mujeres y las niñas en los ámbitos público y privado, incluidas la trata y la explotación sexual y otros tipos de explotación.', 'Activo', '2026-07-16 11:51:57', '2026-07-16 11:51:57'),
	(41, 5, '5.3', 'Eliminar las prácticas nocivas', 'Eliminar todas las prácticas nocivas, como el matrimonio infantil, precoz y forzado y la mutilación genital femenina.', 'Activo', '2026-07-16 11:51:57', '2026-07-16 11:51:57'),
	(42, 5, '5.4', 'Reconocer y valorar el trabajo doméstico y de cuidados', 'Reconocer y valorar los cuidados y el trabajo doméstico no remunerados mediante servicios públicos, infraestructuras, políticas de protección social y la promoción de la responsabilidad compartida en el hogar y la familia.', 'Activo', '2026-07-16 11:51:57', '2026-07-16 11:51:57'),
	(43, 5, '5.5', 'Garantizar la participación plena de las mujeres', 'Asegurar la participación plena y efectiva de las mujeres y la igualdad de oportunidades de liderazgo en todos los niveles decisorios de la vida política, económica y pública.', 'Activo', '2026-07-16 11:51:57', '2026-07-16 11:51:57'),
	(44, 5, '5.6', 'Garantizar el acceso a la salud sexual y reproductiva', 'Asegurar el acceso universal a la salud sexual y reproductiva y los derechos reproductivos, de conformidad con los programas de acción y acuerdos internacionales pertinentes.', 'Activo', '2026-07-16 11:51:57', '2026-07-16 11:51:57'),
	(45, 5, '5.a', 'Garantizar igualdad de derechos a los recursos económicos', 'Emprender reformas que otorguen a las mujeres igualdad de derechos a los recursos económicos, así como acceso a la propiedad, los servicios financieros, la herencia y los recursos naturales.', 'Activo', '2026-07-16 11:51:57', '2026-07-16 11:51:57'),
	(46, 5, '5.b', 'Promover el uso de tecnologías para el empoderamiento de las mujeres', 'Mejorar el uso de la tecnología instrumental, en particular las tecnologías de la información y las comunicaciones, para promover el empoderamiento de las mujeres.', 'Activo', '2026-07-16 11:51:57', '2026-07-16 11:51:57'),
	(47, 5, '5.c', 'Fortalecer políticas y leyes para la igualdad de género', 'Aprobar y fortalecer políticas acertadas y leyes aplicables para promover la igualdad de género y el empoderamiento de todas las mujeres y las niñas a todos los niveles.', 'Activo', '2026-07-16 11:51:57', '2026-07-16 11:51:57'),
	(48, 6, '6.1', 'Lograr el acceso universal al agua potable', 'Para 2030, lograr el acceso universal y equitativo al agua potable a un precio asequible para todos.', 'Activo', '2026-07-16 11:52:22', '2026-07-16 11:52:22'),
	(49, 6, '6.2', 'Lograr el acceso a servicios de saneamiento e higiene', 'Para 2030, lograr el acceso a servicios de saneamiento e higiene adecuados y equitativos para todos y poner fin a la defecación al aire libre, prestando especial atención a las necesidades de las mujeres, las niñas y las personas en situaciones de vulnerabilidad.', 'Activo', '2026-07-16 11:52:22', '2026-07-16 11:52:22'),
	(50, 6, '6.3', 'Mejorar la calidad del agua', 'Para 2030, mejorar la calidad del agua reduciendo la contaminación, eliminando el vertimiento y minimizando la emisión de productos químicos y materiales peligrosos, reduciendo a la mitad el porcentaje de aguas residuales sin tratar y aumentando considerablemente el reciclado y la reutilización segura.', 'Activo', '2026-07-16 11:52:22', '2026-07-16 11:52:22'),
	(51, 6, '6.4', 'Aumentar el uso eficiente de los recursos hídricos', 'Para 2030, aumentar considerablemente el uso eficiente de los recursos hídricos en todos los sectores y asegurar la sostenibilidad de la extracción y el abastecimiento de agua dulce para hacer frente a la escasez de agua.', 'Activo', '2026-07-16 11:52:22', '2026-07-16 11:52:22'),
	(52, 6, '6.5', 'Implementar la gestión integrada de los recursos hídricos', 'Para 2030, implementar la gestión integrada de los recursos hídricos a todos los niveles, incluso mediante la cooperación transfronteriza cuando proceda.', 'Activo', '2026-07-16 11:52:22', '2026-07-16 11:52:22'),
	(53, 6, '6.6', 'Proteger y restaurar los ecosistemas relacionados con el agua', 'Para 2030, proteger y restaurar los ecosistemas relacionados con el agua, incluidos los bosques, montañas, humedales, ríos, acuíferos y lagos.', 'Activo', '2026-07-16 11:52:22', '2026-07-16 11:52:22'),
	(54, 6, '6.a', 'Ampliar la cooperación internacional en agua y saneamiento', 'Para 2030, ampliar la cooperación internacional y el apoyo prestado a los países en desarrollo para la creación de capacidad en actividades y programas relativos al agua y el saneamiento.', 'Activo', '2026-07-16 11:52:22', '2026-07-16 11:52:22'),
	(55, 6, '6.b', 'Fortalecer la participación de las comunidades en la gestión del agua', 'Apoyar y fortalecer la participación de las comunidades locales en la mejora de la gestión del agua y el saneamiento.', 'Activo', '2026-07-16 11:52:22', '2026-07-16 11:52:22'),
	(56, 7, '7.1', 'Garantizar el acceso universal a servicios energéticos', 'Para 2030, garantizar el acceso universal a servicios energéticos asequibles, fiables y modernos.', 'Activo', '2026-07-16 11:52:41', '2026-07-16 11:52:41'),
	(57, 7, '7.2', 'Aumentar la proporción de energías renovables', 'Para 2030, aumentar considerablemente la proporción de energía renovable en el conjunto de fuentes energéticas.', 'Activo', '2026-07-16 11:52:41', '2026-07-16 11:52:41'),
	(58, 7, '7.3', 'Mejorar la eficiencia energética', 'Para 2030, duplicar la tasa mundial de mejora de la eficiencia energética.', 'Activo', '2026-07-16 11:52:41', '2026-07-16 11:52:41'),
	(59, 7, '7.a', 'Fortalecer la cooperación internacional en energía limpia', 'Para 2030, aumentar la cooperación internacional para facilitar el acceso a la investigación y la tecnología relativas a la energía limpia, incluidas las energías renovables, la eficiencia energética y las tecnologías avanzadas y menos contaminantes de combustibles fósiles, y promover la inversión en infraestructura energética y tecnologías limpias.', 'Activo', '2026-07-16 11:52:41', '2026-07-16 11:52:41'),
	(60, 7, '7.b', 'Ampliar la infraestructura y modernizar la tecnología energética', 'Para 2030, ampliar la infraestructura y mejorar la tecnología para prestar servicios energéticos modernos y sostenibles para todos en los países en desarrollo, en particular los países menos adelantados, los pequeños Estados insulares en desarrollo y los países en desarrollo sin litoral.', 'Activo', '2026-07-16 11:52:41', '2026-07-16 11:52:41'),
	(61, 8, '8.1', 'Mantener el crecimiento económico per cápita', 'Mantener el crecimiento económico per cápita de conformidad con las circunstancias nacionales y, en particular, un crecimiento anual del PIB de al menos el 7 % en los países menos adelantados.', 'Activo', '2026-07-16 11:53:17', '2026-07-16 11:53:17'),
	(62, 8, '8.2', 'Aumentar la productividad económica', 'Lograr niveles más elevados de productividad económica mediante la diversificación, la modernización tecnológica y la innovación.', 'Activo', '2026-07-16 11:53:17', '2026-07-16 11:53:17'),
	(63, 8, '8.3', 'Promover políticas para el empleo y las MIPYMES', 'Promover políticas orientadas al desarrollo que apoyen las actividades productivas, la creación de empleo decente, el emprendimiento, la creatividad y la innovación, y fomenten la formalización y el crecimiento de las microempresas y las pequeñas y medianas empresas.', 'Activo', '2026-07-16 11:53:17', '2026-07-16 11:53:17'),
	(64, 8, '8.4', 'Mejorar la eficiencia en el consumo y producción', 'Mejorar progresivamente, hasta 2030, la producción y el consumo eficientes de los recursos mundiales y procurar desvincular el crecimiento económico de la degradación del medio ambiente.', 'Activo', '2026-07-16 11:53:17', '2026-07-16 11:53:17'),
	(65, 8, '8.5', 'Lograr el empleo pleno y el trabajo decente', 'Para 2030, lograr el empleo pleno y productivo y el trabajo decente para todas las mujeres y los hombres, incluidos los jóvenes y las personas con discapacidad, así como la igualdad de remuneración por trabajo de igual valor.', 'Activo', '2026-07-16 11:53:17', '2026-07-16 11:53:17'),
	(66, 8, '8.6', 'Reducir la proporción de jóvenes sin empleo ni estudios', 'Para 2020, reducir considerablemente la proporción de jóvenes que no están empleados y no cursan estudios ni reciben capacitación.', 'Activo', '2026-07-16 11:53:17', '2026-07-16 11:53:17'),
	(67, 8, '8.7', 'Erradicar el trabajo forzoso y el trabajo infantil', 'Adoptar medidas inmediatas y eficaces para erradicar el trabajo forzoso, poner fin a las formas contemporáneas de esclavitud y trata de personas y eliminar las peores formas de trabajo infantil.', 'Activo', '2026-07-16 11:53:17', '2026-07-16 11:53:17'),
	(68, 8, '8.8', 'Proteger los derechos laborales y promover entornos de trabajo seguros', 'Proteger los derechos laborales y promover un entorno de trabajo seguro y sin riesgos para todos los trabajadores, incluidos los trabajadores migrantes.', 'Activo', '2026-07-16 11:53:17', '2026-07-16 11:53:17'),
	(69, 8, '8.9', 'Promover el turismo sostenible', 'Para 2030, elaborar y poner en práctica políticas encaminadas a promover un turismo sostenible que cree puestos de trabajo y promueva la cultura y los productos locales.', 'Activo', '2026-07-16 11:53:17', '2026-07-16 11:53:17'),
	(70, 8, '8.10', 'Fortalecer las instituciones financieras', 'Fortalecer la capacidad de las instituciones financieras nacionales para fomentar y ampliar el acceso a los servicios bancarios, financieros y de seguros para todos.', 'Activo', '2026-07-16 11:53:17', '2026-07-16 11:53:17'),
	(71, 8, '8.a', 'Aumentar el apoyo a la iniciativa Ayuda para el Comercio', 'Aumentar el apoyo a la iniciativa de Ayuda para el Comercio en los países en desarrollo, en particular los menos adelantados.', 'Activo', '2026-07-16 11:53:17', '2026-07-16 11:53:17'),
	(72, 8, '8.b', 'Desarrollar estrategias para el empleo juvenil', 'Para 2020, desarrollar y poner en marcha una estrategia mundial para el empleo de los jóvenes y aplicar el Pacto Mundial para el Empleo de la Organización Internacional del Trabajo.', 'Activo', '2026-07-16 11:53:17', '2026-07-16 11:53:17'),
	(73, 9, '9.1', 'Desarrollar infraestructuras fiables, sostenibles y resilientes', 'Desarrollar infraestructuras fiables, sostenibles, resilientes y de calidad, incluidas infraestructuras regionales y transfronterizas, para apoyar el desarrollo económico y el bienestar humano, con acceso asequible y equitativo para todos.', 'Activo', '2026-07-16 11:54:25', '2026-07-16 11:54:25'),
	(74, 9, '9.2', 'Promover la industrialización inclusiva y sostenible', 'Promover una industrialización inclusiva y sostenible y, de aquí a 2030, aumentar significativamente la contribución de la industria al empleo y al producto interno bruto, de acuerdo con las circunstancias nacionales.', 'Activo', '2026-07-16 11:54:25', '2026-07-16 11:54:25'),
	(75, 9, '9.3', 'Facilitar el acceso de las pequeñas industrias a servicios financieros', 'Aumentar el acceso de las pequeñas industrias y otras empresas, particularmente en los países en desarrollo, a los servicios financieros, incluidos créditos asequibles, y su integración en las cadenas de valor y los mercados.', 'Activo', '2026-07-16 11:54:25', '2026-07-16 11:54:25'),
	(76, 9, '9.4', 'Modernizar la infraestructura y reconvertir las industrias', 'Para 2030, modernizar la infraestructura y reconvertir las industrias para que sean sostenibles, utilizando los recursos con mayor eficiencia y promoviendo tecnologías limpias y ambientalmente racionales.', 'Activo', '2026-07-16 11:54:25', '2026-07-16 11:54:25'),
	(77, 9, '9.5', 'Fortalecer la investigación científica y la innovación', 'Aumentar la investigación científica y mejorar la capacidad tecnológica de los sectores industriales de todos los países, fomentando la innovación e incrementando el número de personas dedicadas a investigación y desarrollo.', 'Activo', '2026-07-16 11:54:25', '2026-07-16 11:54:25'),
	(78, 9, '9.a', 'Facilitar infraestructura sostenible para países en desarrollo', 'Facilitar el desarrollo de infraestructuras sostenibles y resilientes en los países en desarrollo mediante un mayor apoyo financiero, tecnológico y técnico.', 'Activo', '2026-07-16 11:54:25', '2026-07-16 11:54:25'),
	(79, 9, '9.b', 'Apoyar el desarrollo tecnológico y la innovación nacional', 'Apoyar el desarrollo de tecnologías, la investigación y la innovación nacionales en los países en desarrollo, incluso garantizando un entorno normativo propicio para la diversificación industrial y la adición de valor a los productos básicos.', 'Activo', '2026-07-16 11:54:25', '2026-07-16 11:54:25'),
	(80, 9, '9.c', 'Ampliar el acceso a las tecnologías de la información y las comunicaciones', 'Aumentar significativamente el acceso a las tecnologías de la información y las comunicaciones y esforzarse por proporcionar acceso universal y asequible a Internet en los países menos adelantados.', 'Activo', '2026-07-16 11:54:25', '2026-07-16 11:54:25'),
	(81, 10, '10.1', 'Reducir las desigualdades de ingresos', 'Para 2030, lograr progresivamente y mantener el crecimiento de los ingresos del 40 % más pobre de la población a una tasa superior a la media nacional.', 'Activo', '2026-07-16 11:54:33', '2026-07-16 11:54:33'),
	(82, 10, '10.2', 'Promover la inclusión social, económica y política', 'Para 2030, potenciar y promover la inclusión social, económica y política de todas las personas, independientemente de su edad, sexo, discapacidad, raza, etnia, origen, religión o situación económica u otra condición.', 'Activo', '2026-07-16 11:54:33', '2026-07-16 11:54:33'),
	(83, 10, '10.3', 'Garantizar la igualdad de oportunidades', 'Garantizar la igualdad de oportunidades y reducir la desigualdad de resultados, eliminando leyes, políticas y prácticas discriminatorias y promoviendo legislaciones y medidas adecuadas.', 'Activo', '2026-07-16 11:54:33', '2026-07-16 11:54:33'),
	(84, 10, '10.4', 'Adoptar políticas fiscales, salariales y de protección social', 'Adoptar políticas, especialmente fiscales, salariales y de protección social, y lograr progresivamente una mayor igualdad.', 'Activo', '2026-07-16 11:54:33', '2026-07-16 11:54:33'),
	(85, 10, '10.5', 'Mejorar la regulación de los mercados financieros', 'Mejorar la reglamentación y vigilancia de las instituciones y los mercados financieros mundiales y fortalecer la aplicación de esas normas.', 'Activo', '2026-07-16 11:54:33', '2026-07-16 11:54:33'),
	(86, 10, '10.6', 'Aumentar la representación de los países en desarrollo', 'Asegurar una mayor representación e intervención de los países en desarrollo en las instituciones internacionales de adopción de decisiones económicas y financieras.', 'Activo', '2026-07-16 11:54:33', '2026-07-16 11:54:33'),
	(87, 10, '10.7', 'Facilitar la migración y movilidad ordenada', 'Facilitar la migración y la movilidad ordenadas, seguras, regulares y responsables de las personas mediante políticas migratorias planificadas y bien gestionadas.', 'Activo', '2026-07-16 11:54:33', '2026-07-16 11:54:33'),
	(88, 10, '10.a', 'Aplicar el principio de trato especial y diferenciado', 'Aplicar el principio del trato especial y diferenciado para los países en desarrollo, en particular los países menos adelantados, de conformidad con los acuerdos de la Organización Mundial del Comercio.', 'Activo', '2026-07-16 11:54:33', '2026-07-16 11:54:33'),
	(89, 10, '10.b', 'Fomentar la asistencia y las corrientes financieras', 'Fomentar la asistencia oficial para el desarrollo y las corrientes financieras, incluida la inversión extranjera directa, para los Estados con mayores necesidades.', 'Activo', '2026-07-16 11:54:33', '2026-07-16 11:54:33'),
	(90, 10, '10.c', 'Reducir los costos de las remesas', 'Para 2030, reducir a menos del 3 % los costos de transacción de las remesas de los migrantes y eliminar los corredores de remesas con costos superiores al 5 %.', 'Activo', '2026-07-16 11:54:33', '2026-07-16 11:54:33'),
	(91, 11, '11.1', 'Garantizar el acceso a viviendas y servicios básicos adecuados', 'Para 2030, asegurar el acceso de todas las personas a viviendas y servicios básicos adecuados, seguros y asequibles y mejorar los barrios marginales.', 'Activo', '2026-07-16 11:54:42', '2026-07-16 11:54:42'),
	(92, 11, '11.2', 'Proporcionar sistemas de transporte seguros y sostenibles', 'Para 2030, proporcionar acceso a sistemas de transporte seguros, asequibles, accesibles y sostenibles para todos, mejorando la seguridad vial y prestando especial atención a las necesidades de las personas en situación de vulnerabilidad.', 'Activo', '2026-07-16 11:54:42', '2026-07-16 11:54:42'),
	(93, 11, '11.3', 'Promover la urbanización inclusiva y sostenible', 'Para 2030, aumentar la urbanización inclusiva y sostenible y la capacidad para la planificación y gestión participativas, integradas y sostenibles de los asentamientos humanos.', 'Activo', '2026-07-16 11:54:42', '2026-07-16 11:54:42'),
	(94, 11, '11.4', 'Proteger el patrimonio cultural y natural', 'Redoblar los esfuerzos para proteger y salvaguardar el patrimonio cultural y natural del mundo.', 'Activo', '2026-07-16 11:54:42', '2026-07-16 11:54:42'),
	(95, 11, '11.5', 'Reducir el impacto de los desastres', 'Para 2030, reducir significativamente el número de muertes y personas afectadas por los desastres, incluidos los relacionados con el agua, y disminuir considerablemente las pérdidas económicas directas causadas por ellos.', 'Activo', '2026-07-16 11:54:42', '2026-07-16 11:54:42'),
	(96, 11, '11.6', 'Reducir el impacto ambiental de las ciudades', 'Para 2030, reducir el impacto ambiental negativo per cápita de las ciudades, prestando especial atención a la calidad del aire y la gestión de los desechos municipales.', 'Activo', '2026-07-16 11:54:42', '2026-07-16 11:54:42'),
	(97, 11, '11.7', 'Proporcionar acceso universal a espacios públicos seguros', 'Para 2030, proporcionar acceso universal a zonas verdes y espacios públicos seguros, inclusivos y accesibles, especialmente para las mujeres, los niños, las personas mayores y las personas con discapacidad.', 'Activo', '2026-07-16 11:54:42', '2026-07-16 11:54:42'),
	(98, 11, '11.a', 'Fortalecer la planificación del desarrollo regional', 'Apoyar los vínculos económicos, sociales y ambientales positivos entre las zonas urbanas, periurbanas y rurales fortaleciendo la planificación del desarrollo nacional y regional.', 'Activo', '2026-07-16 11:54:42', '2026-07-16 11:54:42'),
	(99, 11, '11.b', 'Implementar políticas para ciudades resilientes', 'Para 2020, aumentar considerablemente el número de ciudades y asentamientos humanos que adoptan e implementan políticas y planes integrados para la inclusión, el uso eficiente de los recursos, la mitigación y adaptación al cambio climático y la resiliencia frente a desastres.', 'Activo', '2026-07-16 11:54:42', '2026-07-16 11:54:42'),
	(100, 11, '11.c', 'Apoyar construcciones sostenibles en países menos adelantados', 'Apoyar a los países menos adelantados, incluso mediante asistencia financiera y técnica, para que construyan edificios sostenibles y resilientes utilizando materiales locales.', 'Activo', '2026-07-16 11:54:42', '2026-07-16 11:54:42'),
	(101, 12, '12.1', 'Aplicar el Marco Decenal sobre Consumo y Producción Sostenibles', 'Aplicar el Marco Decenal de Programas sobre Modalidades de Consumo y Producción Sostenibles, con la participación de todos los países y bajo el liderazgo de los países desarrollados.', 'Activo', '2026-07-16 11:54:51', '2026-07-16 11:54:51'),
	(102, 12, '12.2', 'Gestionar sosteniblemente los recursos naturales', 'Para 2030, lograr la gestión sostenible y el uso eficiente de los recursos naturales.', 'Activo', '2026-07-16 11:54:51', '2026-07-16 11:54:51'),
	(103, 12, '12.3', 'Reducir el desperdicio de alimentos', 'Para 2030, reducir a la mitad el desperdicio mundial de alimentos per cápita en la venta al por menor y a nivel de los consumidores y reducir las pérdidas de alimentos en las cadenas de producción y suministro.', 'Activo', '2026-07-16 11:54:51', '2026-07-16 11:54:51'),
	(104, 12, '12.4', 'Gestionar racionalmente los productos químicos y desechos', 'Para 2030, lograr la gestión ecológicamente racional de los productos químicos y de todos los desechos durante todo su ciclo de vida, reduciendo significativamente su liberación a la atmósfera, el agua y el suelo.', 'Activo', '2026-07-16 11:54:51', '2026-07-16 11:54:51'),
	(105, 12, '12.5', 'Reducir la generación de desechos', 'Para 2030, reducir considerablemente la generación de desechos mediante actividades de prevención, reducción, reciclado y reutilización.', 'Activo', '2026-07-16 11:54:51', '2026-07-16 11:54:51'),
	(106, 12, '12.6', 'Promover prácticas empresariales sostenibles', 'Alentar a las empresas, especialmente las grandes y transnacionales, a adoptar prácticas sostenibles e incorporar información sobre sostenibilidad en su ciclo de presentación de informes.', 'Activo', '2026-07-16 11:54:51', '2026-07-16 11:54:51'),
	(107, 12, '12.7', 'Promover adquisiciones públicas sostenibles', 'Promover prácticas de adquisición pública que sean sostenibles, de conformidad con las políticas y prioridades nacionales.', 'Activo', '2026-07-16 11:54:51', '2026-07-16 11:54:51'),
	(108, 12, '12.8', 'Promover información y sensibilización para el desarrollo sostenible', 'Para 2030, asegurar que todas las personas tengan la información y los conocimientos necesarios para el desarrollo sostenible y los estilos de vida en armonía con la naturaleza.', 'Activo', '2026-07-16 11:54:51', '2026-07-16 11:54:51'),
	(109, 12, '12.a', 'Fortalecer capacidades científicas y tecnológicas', 'Apoyar a los países en desarrollo para fortalecer su capacidad científica y tecnológica hacia modalidades de consumo y producción más sostenibles.', 'Activo', '2026-07-16 11:54:51', '2026-07-16 11:54:51'),
	(110, 12, '12.b', 'Desarrollar herramientas para el turismo sostenible', 'Elaborar y aplicar instrumentos para vigilar los efectos en el desarrollo sostenible con miras a lograr un turismo sostenible que genere empleo y promueva la cultura y los productos locales.', 'Activo', '2026-07-16 11:54:51', '2026-07-16 11:54:51'),
	(111, 12, '12.c', 'Eliminar subsidios ineficientes a combustibles fósiles', 'Racionalizar los subsidios ineficientes a los combustibles fósiles que fomentan el consumo antieconómico, teniendo en cuenta las necesidades y condiciones específicas de los países en desarrollo.', 'Activo', '2026-07-16 11:54:51', '2026-07-16 11:54:51'),
	(112, 13, '13.1', 'Fortalecer la resiliencia frente al cambio climático', 'Fortalecer la resiliencia y la capacidad de adaptación a los riesgos relacionados con el clima y los desastres naturales en todos los países.', 'Activo', '2026-07-16 11:56:29', '2026-07-16 11:56:29'),
	(113, 13, '13.2', 'Incorporar medidas sobre cambio climático en las políticas nacionales', 'Incorporar medidas relativas al cambio climático en las políticas, estrategias y planes nacionales.', 'Activo', '2026-07-16 11:56:29', '2026-07-16 11:56:29'),
	(114, 13, '13.3', 'Mejorar la educación y la capacidad sobre cambio climático', 'Mejorar la educación, la sensibilización y la capacidad humana e institucional respecto de la mitigación del cambio climático, la adaptación a él, la reducción de sus efectos y la alerta temprana.', 'Activo', '2026-07-16 11:56:29', '2026-07-16 11:56:29'),
	(115, 13, '13.a', 'Movilizar recursos para la acción climática', 'Cumplir el compromiso de movilizar conjuntamente 100.000 millones de dólares anuales para atender las necesidades de los países en desarrollo respecto de la mitigación y adaptación al cambio climático y poner en pleno funcionamiento el Fondo Verde para el Clima.', 'Activo', '2026-07-16 11:56:29', '2026-07-16 11:56:29'),
	(116, 13, '13.b', 'Fortalecer la capacidad de planificación climática', 'Promover mecanismos para aumentar la capacidad para la planificación y gestión eficaces relacionadas con el cambio climático en los países menos adelantados y los pequeños Estados insulares en desarrollo, prestando especial atención a las mujeres, los jóvenes y las comunidades locales y marginadas.', 'Activo', '2026-07-16 11:56:29', '2026-07-16 11:56:29'),
	(117, 14, '14.1', 'Reducir la contaminación marina', 'Para 2025, prevenir y reducir significativamente la contaminación marina de todo tipo, en particular la producida por actividades realizadas en tierra, incluidos los desechos marinos y la contaminación por nutrientes.', 'Activo', '2026-07-16 11:56:40', '2026-07-16 11:56:40'),
	(118, 14, '14.2', 'Gestionar y proteger los ecosistemas marinos', 'Para 2030, gestionar y proteger de manera sostenible los ecosistemas marinos y costeros para evitar efectos adversos importantes, incluso fortaleciendo su resiliencia, y adoptar medidas para restaurarlos.', 'Activo', '2026-07-16 11:56:40', '2026-07-16 11:56:40'),
	(119, 14, '14.3', 'Reducir la acidificación de los océanos', 'Minimizar y abordar los efectos de la acidificación de los océanos, incluso mediante una mayor cooperación científica a todos los niveles.', 'Activo', '2026-07-16 11:56:40', '2026-07-16 11:56:40'),
	(120, 14, '14.4', 'Regular la pesca y poner fin a la sobrepesca', 'Para 2020, reglamentar eficazmente la explotación pesquera y poner fin a la sobrepesca, la pesca ilegal, no declarada y no reglamentada y las prácticas pesqueras destructivas.', 'Activo', '2026-07-16 11:56:40', '2026-07-16 11:56:40'),
	(121, 14, '14.5', 'Conservar las zonas marinas y costeras', 'Para 2020, conservar al menos el 10 % de las zonas costeras y marinas, de conformidad con las leyes nacionales y el derecho internacional.', 'Activo', '2026-07-16 11:56:40', '2026-07-16 11:56:40'),
	(122, 14, '14.6', 'Eliminar subsidios perjudiciales para la pesca', 'Para 2020, prohibir ciertas formas de subvenciones a la pesca que contribuyen a la sobrecapacidad y la sobrepesca y eliminar las subvenciones que fomentan la pesca ilegal, no declarada y no reglamentada.', 'Activo', '2026-07-16 11:56:40', '2026-07-16 11:56:40'),
	(123, 14, '14.7', 'Aumentar los beneficios económicos del uso sostenible de los recursos marinos', 'Para 2030, aumentar los beneficios económicos que los pequeños Estados insulares en desarrollo y los países menos adelantados obtienen del uso sostenible de los recursos marinos, en particular mediante la gestión sostenible de la pesca, la acuicultura y el turismo.', 'Activo', '2026-07-16 11:56:40', '2026-07-16 11:56:40'),
	(124, 14, '14.a', 'Fortalecer la investigación científica y la tecnología marina', 'Aumentar los conocimientos científicos, desarrollar la capacidad de investigación y transferir tecnología marina para mejorar la salud de los océanos y potenciar la contribución de la biodiversidad marina al desarrollo.', 'Activo', '2026-07-16 11:56:40', '2026-07-16 11:56:40'),
	(125, 14, '14.b', 'Facilitar el acceso de los pescadores artesanales a los recursos marinos', 'Facilitar el acceso de los pescadores artesanales a los recursos marinos y los mercados.', 'Activo', '2026-07-16 11:56:40', '2026-07-16 11:56:40'),
	(126, 14, '14.c', 'Aplicar el derecho internacional para la conservación de los océanos', 'Mejorar la conservación y el uso sostenible de los océanos y sus recursos aplicando el derecho internacional reflejado en la Convención de las Naciones Unidas sobre el Derecho del Mar.', 'Activo', '2026-07-16 11:56:40', '2026-07-16 11:56:40'),
	(127, 15, '15.1', 'Conservar y restaurar los ecosistemas terrestres y de agua dulce', 'Para 2030, asegurar la conservación, el restablecimiento y el uso sostenible de los ecosistemas terrestres y los ecosistemas interiores de agua dulce y sus servicios, en particular los bosques, humedales, montañas y zonas áridas.', 'Activo', '2026-07-16 11:56:49', '2026-07-16 11:56:49'),
	(128, 15, '15.2', 'Gestionar sosteniblemente los bosques', 'Para 2030, promover la gestión sostenible de todos los tipos de bosques, poner fin a la deforestación, recuperar los bosques degradados y aumentar considerablemente la forestación y la reforestación a nivel mundial.', 'Activo', '2026-07-16 11:56:49', '2026-07-16 11:56:49'),
	(129, 15, '15.3', 'Combatir la desertificación y restaurar las tierras degradadas', 'Para 2030, luchar contra la desertificación, rehabilitar las tierras y los suelos degradados y procurar lograr un mundo con efecto neutro en la degradación del suelo.', 'Activo', '2026-07-16 11:56:49', '2026-07-16 11:56:49'),
	(130, 15, '15.4', 'Conservar los ecosistemas montañosos', 'Para 2030, asegurar la conservación de los ecosistemas montañosos, incluida su diversidad biológica, para mejorar su capacidad de proporcionar beneficios esenciales para el desarrollo sostenible.', 'Activo', '2026-07-16 11:56:49', '2026-07-16 11:56:49'),
	(131, 15, '15.5', 'Detener la pérdida de biodiversidad', 'Adoptar medidas urgentes y significativas para reducir la degradación de los hábitats naturales, detener la pérdida de biodiversidad y proteger las especies amenazadas.', 'Activo', '2026-07-16 11:56:49', '2026-07-16 11:56:49'),
	(132, 15, '15.6', 'Garantizar el acceso justo a los recursos genéticos', 'Promover la participación justa y equitativa en los beneficios derivados de la utilización de los recursos genéticos y promover el acceso adecuado a dichos recursos.', 'Activo', '2026-07-16 11:56:49', '2026-07-16 11:56:49'),
	(133, 15, '15.7', 'Poner fin a la caza furtiva y al tráfico de especies protegidas', 'Adoptar medidas urgentes para poner fin a la caza furtiva y al tráfico de especies protegidas de flora y fauna y abordar la demanda y oferta de productos ilegales derivados de la vida silvestre.', 'Activo', '2026-07-16 11:56:49', '2026-07-16 11:56:49'),
	(134, 15, '15.8', 'Prevenir la introducción de especies exóticas invasoras', 'Para 2030, adoptar medidas para prevenir la introducción y reducir significativamente el impacto de las especies exóticas invasoras en los ecosistemas terrestres y acuáticos.', 'Activo', '2026-07-16 11:56:49', '2026-07-16 11:56:49'),
	(135, 15, '15.9', 'Integrar la biodiversidad en la planificación nacional', 'Para 2030, integrar los valores de los ecosistemas y la biodiversidad en la planificación nacional y local, los procesos de desarrollo y las estrategias de reducción de la pobreza.', 'Activo', '2026-07-16 11:56:49', '2026-07-16 11:56:49'),
	(136, 15, '15.a', 'Movilizar recursos financieros para conservar la biodiversidad', 'Movilizar y aumentar significativamente los recursos financieros procedentes de todas las fuentes para conservar y utilizar de manera sostenible la biodiversidad y los ecosistemas.', 'Activo', '2026-07-16 11:56:49', '2026-07-16 11:56:49'),
	(137, 15, '15.b', 'Financiar la gestión forestal sostenible', 'Movilizar recursos significativos para financiar la gestión forestal sostenible y proporcionar incentivos adecuados a los países en desarrollo para promover dicha gestión.', 'Activo', '2026-07-16 11:56:49', '2026-07-16 11:56:49'),
	(138, 15, '15.c', 'Combatir el tráfico ilegal de especies protegidas', 'Aumentar el apoyo mundial para combatir la caza furtiva y el tráfico de especies protegidas, fortaleciendo la capacidad de las comunidades locales para aprovechar oportunidades de subsistencia sostenibles.', 'Activo', '2026-07-16 11:56:49', '2026-07-16 11:56:49'),
	(139, 16, '16.1', 'Reducir todas las formas de violencia', 'Reducir significativamente todas las formas de violencia y las correspondientes tasas de mortalidad en todo el mundo.', 'Activo', '2026-07-16 11:57:00', '2026-07-16 11:57:00'),
	(140, 16, '16.2', 'Poner fin al maltrato, la explotación y la trata de niños', 'Poner fin al maltrato, la explotación, la trata y todas las formas de violencia y tortura contra los niños.', 'Activo', '2026-07-16 11:57:00', '2026-07-16 11:57:00'),
	(141, 16, '16.3', 'Promover el Estado de derecho y el acceso a la justicia', 'Promover el Estado de derecho en los planos nacional e internacional y garantizar la igualdad de acceso a la justicia para todos.', 'Activo', '2026-07-16 11:57:00', '2026-07-16 11:57:00'),
	(142, 16, '16.4', 'Reducir las corrientes financieras y de armas ilícitas', 'De aquí a 2030, reducir significativamente las corrientes financieras y de armas ilícitas, fortalecer la recuperación y devolución de los activos robados y luchar contra todas las formas de delincuencia organizada.', 'Activo', '2026-07-16 11:57:00', '2026-07-16 11:57:00'),
	(143, 16, '16.5', 'Reducir la corrupción y el soborno', 'Reducir considerablemente la corrupción y el soborno en todas sus formas.', 'Activo', '2026-07-16 11:57:00', '2026-07-16 11:57:00'),
	(144, 16, '16.6', 'Crear instituciones eficaces y transparentes', 'Crear instituciones eficaces, responsables y transparentes a todos los niveles.', 'Activo', '2026-07-16 11:57:00', '2026-07-16 11:57:00'),
	(145, 16, '16.7', 'Garantizar decisiones inclusivas y participativas', 'Garantizar la adopción en todos los niveles de decisiones inclusivas, participativas y representativas que respondan a las necesidades.', 'Activo', '2026-07-16 11:57:00', '2026-07-16 11:57:00'),
	(146, 16, '16.8', 'Fortalecer la participación de los países en desarrollo', 'Ampliar y fortalecer la participación de los países en desarrollo en las instituciones de gobernanza mundial.', 'Activo', '2026-07-16 11:57:00', '2026-07-16 11:57:00'),
	(147, 16, '16.9', 'Garantizar la identidad jurídica para todos', 'Para 2030, proporcionar acceso a una identidad jurídica para todos, en particular mediante el registro de nacimientos.', 'Activo', '2026-07-16 11:57:00', '2026-07-16 11:57:00'),
	(148, 16, '16.10', 'Garantizar el acceso público a la información y proteger las libertades fundamentales', 'Garantizar el acceso público a la información y proteger las libertades fundamentales, de conformidad con la legislación nacional y los acuerdos internacionales.', 'Activo', '2026-07-16 11:57:00', '2026-07-16 11:57:00'),
	(149, 16, '16.a', 'Fortalecer las instituciones nacionales para prevenir la violencia', 'Fortalecer las instituciones nacionales pertinentes, incluso mediante la cooperación internacional, para crear capacidad a todos los niveles, en particular en los países en desarrollo, con el fin de prevenir la violencia y combatir el terrorismo y la delincuencia.', 'Activo', '2026-07-16 11:57:00', '2026-07-16 11:57:00'),
	(150, 16, '16.b', 'Promover leyes y políticas no discriminatorias', 'Promover y aplicar leyes y políticas no discriminatorias en favor del desarrollo sostenible.', 'Activo', '2026-07-16 11:57:00', '2026-07-16 11:57:00'),
	(151, 17, '17.1', 'Fortalecer la movilización de recursos internos', 'Fortalecer la movilización de recursos internos, incluso mediante el apoyo internacional a los países en desarrollo, para mejorar la capacidad nacional de recaudar ingresos fiscales y de otra índole.', 'Activo', '2026-07-16 11:57:16', '2026-07-16 11:57:16'),
	(152, 17, '17.2', 'Cumplir los compromisos de asistencia oficial para el desarrollo', 'Velar por que los países desarrollados cumplan plenamente sus compromisos en relación con la asistencia oficial para el desarrollo.', 'Activo', '2026-07-16 11:57:16', '2026-07-16 11:57:16'),
	(153, 17, '17.3', 'Movilizar recursos financieros adicionales', 'Movilizar recursos financieros adicionales de múltiples fuentes para los países en desarrollo.', 'Activo', '2026-07-16 11:57:16', '2026-07-16 11:57:16'),
	(154, 17, '17.4', 'Ayudar a lograr la sostenibilidad de la deuda', 'Ayudar a los países en desarrollo a lograr la sostenibilidad de la deuda a largo plazo mediante políticas coordinadas.', 'Activo', '2026-07-16 11:57:16', '2026-07-16 11:57:16'),
	(155, 17, '17.5', 'Promover la inversión en los países menos adelantados', 'Adoptar y aplicar sistemas de promoción de las inversiones en favor de los países menos adelantados.', 'Activo', '2026-07-16 11:57:16', '2026-07-16 11:57:16'),
	(156, 17, '17.6', 'Fortalecer la cooperación científica y tecnológica', 'Mejorar la cooperación regional e internacional Norte-Sur, Sur-Sur y triangular en ciencia, tecnología e innovación.', 'Activo', '2026-07-16 11:57:16', '2026-07-16 11:57:16'),
	(157, 17, '17.7', 'Promover tecnologías ambientalmente racionales', 'Promover el desarrollo, la transferencia, la difusión y la utilización de tecnologías ecológicamente racionales en condiciones favorables.', 'Activo', '2026-07-16 11:57:16', '2026-07-16 11:57:16'),
	(158, 17, '17.8', 'Fortalecer la capacidad tecnológica', 'Poner plenamente en funcionamiento el banco de tecnología y fortalecer la utilización de tecnologías instrumentales, en particular las tecnologías de la información y las comunicaciones.', 'Activo', '2026-07-16 11:57:16', '2026-07-16 11:57:16'),
	(159, 17, '17.9', 'Fortalecer la creación de capacidades', 'Aumentar el apoyo internacional para realizar actividades eficaces y específicas de creación de capacidad en los países en desarrollo.', 'Activo', '2026-07-16 11:57:16', '2026-07-16 11:57:16'),
	(160, 17, '17.10', 'Promover un sistema de comercio multilateral', 'Promover un sistema de comercio multilateral universal, basado en normas, abierto, no discriminatorio y equitativo bajo la Organización Mundial del Comercio.', 'Activo', '2026-07-16 11:57:16', '2026-07-16 11:57:16'),
	(161, 17, '17.11', 'Aumentar las exportaciones de los países en desarrollo', 'Aumentar significativamente las exportaciones de los países en desarrollo, en particular con miras a duplicar la participación de los países menos adelantados en las exportaciones mundiales.', 'Activo', '2026-07-16 11:57:16', '2026-07-16 11:57:16'),
	(162, 17, '17.12', 'Facilitar el acceso a los mercados para los países menos adelantados', 'Lograr la consecución oportuna del acceso a los mercados libre de derechos y contingentes para todos los países menos adelantados.', 'Activo', '2026-07-16 11:57:16', '2026-07-16 11:57:16'),
	(163, 17, '17.13', 'Mejorar la estabilidad macroeconómica mundial', 'Aumentar la estabilidad macroeconómica mundial mediante la coordinación y coherencia de las políticas.', 'Activo', '2026-07-16 11:57:16', '2026-07-16 11:57:16'),
	(164, 17, '17.14', 'Mejorar la coherencia de las políticas para el desarrollo sostenible', 'Mejorar la coherencia de las políticas para el desarrollo sostenible.', 'Activo', '2026-07-16 11:57:16', '2026-07-16 11:57:16'),
	(165, 17, '17.15', 'Respetar el liderazgo nacional', 'Respetar el margen normativo y el liderazgo de cada país para establecer y aplicar políticas orientadas a la erradicación de la pobreza y el desarrollo sostenible.', 'Activo', '2026-07-16 11:57:16', '2026-07-16 11:57:16'),
	(166, 17, '17.16', 'Fortalecer la Alianza Mundial para el Desarrollo Sostenible', 'Fortalecer la Alianza Mundial para el Desarrollo Sostenible, complementada por alianzas entre múltiples interesados que movilicen e intercambien conocimientos, especialización, tecnología y recursos financieros.', 'Activo', '2026-07-16 11:57:16', '2026-07-16 11:57:16'),
	(167, 17, '17.17', 'Fomentar alianzas eficaces entre múltiples interesados', 'Fomentar y promover alianzas eficaces en las esferas pública, público-privada y de la sociedad civil, aprovechando la experiencia y las estrategias de obtención de recursos de las alianzas.', 'Activo', '2026-07-16 11:57:16', '2026-07-16 11:57:16'),
	(168, 17, '17.18', 'Mejorar la disponibilidad de datos', 'Para 2020, mejorar el apoyo a la creación de capacidad para aumentar significativamente la disponibilidad de datos oportunos, fiables y de alta calidad desglosados por ingresos, género, edad, raza, etnia, situación migratoria, discapacidad, ubicación geográfica y otras características pertinentes.', 'Activo', '2026-07-16 11:57:16', '2026-07-16 11:57:16'),
	(169, 17, '17.19', 'Desarrollar indicadores para medir el desarrollo sostenible', 'Para 2030, aprovechar las iniciativas existentes para elaborar indicadores que permitan medir los progresos en materia de desarrollo sostenible y apoyar el fortalecimiento de la capacidad estadística de los países en desarrollo.', 'Activo', '2026-07-16 11:57:16', '2026-07-16 11:57:16');

-- Volcando estructura para tabla sipeip.password_reset_tokens
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.password_reset_tokens: ~0 rows (aproximadamente)

-- Volcando estructura para tabla sipeip.planes
DROP TABLE IF EXISTS `planes`;
CREATE TABLE IF NOT EXISTS `planes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entidad_id` bigint unsigned NOT NULL,
  `tipo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periodo_inicio` year NOT NULL,
  `periodo_fin` year NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `estado` enum('Activo','Inactivo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activo',
  `estado_proceso` enum('Borrador','En revisión','Observado','Aprobado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Borrador',
  `version` int unsigned NOT NULL DEFAULT '1',
  `usuario_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `planes_codigo_unique` (`codigo`),
  KEY `planes_entidad_id_foreign` (`entidad_id`),
  KEY `planes_usuario_id_foreign` (`usuario_id`),
  CONSTRAINT `planes_entidad_id_foreign` FOREIGN KEY (`entidad_id`) REFERENCES `entidades` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `planes_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.planes: ~6 rows (aproximadamente)
INSERT INTO `planes` (`id`, `codigo`, `nombre`, `entidad_id`, `tipo`, `periodo_inicio`, `periodo_fin`, `descripcion`, `estado`, `estado_proceso`, `version`, `usuario_id`, `created_at`, `updated_at`) VALUES
	(1, 'PEI-MTOP-001', 'Plan Estratégico Institucional del Ministerio de Transporte y Obras Públicas PRUEBA DE EDITADO', 2, 'Plan Estratégico Institucional', '2026', '2029', 'Instrumento de planificación institucional que establece los objetivos estratégicos, indicadores, metas y lineamientos del Ministerio de Transporte y Obras Públicas para el período 2026 - 2029.  PRUEBA DE EDITADO', 'Activo', 'Borrador', 1, 5, '2026-08-25 07:25:32', '2026-09-11 07:43:12'),
	(2, 'PEI-MTOP-002', 'Plan Estratégico Institucional MTOP 2026–2029', 2, 'Plan Estratégico Institucional', '2026', '2029', 'Instrumento de planificación institucional orientado al cumplimiento de los objetivos estratégicos del Ministerio de Transporte y Obras Públicas durante el período 2026–2029.', 'Activo', 'Borrador', 1, 5, '2026-09-11 07:45:24', '2026-09-11 07:45:24'),
	(3, 'PEI-MTOP-003', 'Plan Estratégico Institucional para el Fortalecimiento de la Infraestructura y la Movilidad Segura', 2, 'Plan Estratégico Institucional', '2026', '2029', 'Instrumento de planificación orientado a fortalecer la calidad, conservación, seguridad y resiliencia de la infraestructura del transporte, mejorar la conectividad territorial y promover servicios de movilidad seguros, eficientes y sostenibles en el Ecuador durante el período 2026–2029.', 'Activo', 'Borrador', 1, 5, '2026-09-15 07:06:08', '2026-09-17 03:36:07'),
	(4, 'PEI-MTOP-004', 'prueba 123', 2, 'Plan Estratégico Institucional', '2001', '2002', 'prueba 123', 'Activo', 'Borrador', 1, 5, '2026-09-15 07:17:39', '2026-09-17 18:19:58'),
	(5, 'PEI-MTOP-005', 'computador', 2, 'Plan Estratégico Institucional', '2001', '2002', 'sdsadsadsadsadsad', 'Activo', 'Borrador', 1, 5, '2026-09-17 19:38:53', '2026-09-17 19:38:53'),
	(6, 'PEI-MTOP-006', 'vcbcvbcvbcvbcvbcvbv', 2, 'Plan Estratégico Institucional', '2002', '2002', 'cvbcvbcvbvcb', 'Activo', 'Borrador', 1, 5, '2026-09-17 19:40:47', '2026-09-17 19:40:47'),
	(7, 'PEI-MTOP-007', 'prueba completa planificacion', 2, 'Plan Estratégico Institucional', '2003', '2004', 'prueba completa planificacion', 'Activo', 'Borrador', 1, 5, '2026-09-17 20:19:52', '2026-09-17 20:19:52');

-- Volcando estructura para tabla sipeip.pnd
DROP TABLE IF EXISTS `pnd`;
CREATE TABLE IF NOT EXISTS `pnd` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periodo_inicio` year NOT NULL,
  `periodo_fin` year NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.pnd: ~0 rows (aproximadamente)
INSERT INTO `pnd` (`id`, `nombre`, `periodo_inicio`, `periodo_fin`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
	(1, 'Plan de Desarrollo para el Nuevo Ecuador', '2024', '2025', 'Plan Nacional de Desarrollo del Ecuador para el período 2024-2025.', 'Activo', '2026-08-25 07:25:25', '2026-08-25 07:25:25');

-- Volcando estructura para tabla sipeip.pnd_ejes
DROP TABLE IF EXISTS `pnd_ejes`;
CREATE TABLE IF NOT EXISTS `pnd_ejes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pnd_id` bigint unsigned NOT NULL,
  `numero` tinyint unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pnd_ejes_pnd_numero_unique` (`pnd_id`,`numero`),
  CONSTRAINT `pnd_ejes_pnd_id_foreign` FOREIGN KEY (`pnd_id`) REFERENCES `pnd` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.pnd_ejes: ~5 rows (aproximadamente)
INSERT INTO `pnd_ejes` (`id`, `pnd_id`, `numero`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Social', 'Eje orientado a mejorar la calidad de vida de la población y garantizar derechos y servicios públicos.', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(2, 1, 2, 'Desarrollo Económico', 'Eje orientado al impulso productivo, la innovación, la inversión y el fortalecimiento económico.', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(3, 1, 3, 'Infraestructura, Energía y Medio Ambiente', 'Eje orientado a infraestructura, energía y uso responsable de los recursos naturales.', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(4, 1, 4, 'Institucional', 'Eje orientado a fortalecer la transparencia, eficiencia y calidad de las instituciones públicas.', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(5, 1, 5, 'Gestión de Riesgos', 'Eje orientado a promover la resiliencia de ciudades y comunidades frente a riesgos naturales y antrópicos.', '2026-08-25 07:25:26', '2026-08-25 07:25:26');

-- Volcando estructura para tabla sipeip.pnd_estrategias
DROP TABLE IF EXISTS `pnd_estrategias`;
CREATE TABLE IF NOT EXISTS `pnd_estrategias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pnd_politica_id` bigint unsigned NOT NULL,
  `codigo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pnd_estrategias_codigo_unique` (`codigo`),
  KEY `pnd_estrategias_pnd_politica_id_foreign` (`pnd_politica_id`),
  CONSTRAINT `pnd_estrategias_pnd_politica_id_foreign` FOREIGN KEY (`pnd_politica_id`) REFERENCES `pnd_politicas` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.pnd_estrategias: ~186 rows (aproximadamente)
INSERT INTO `pnd_estrategias` (`id`, `pnd_politica_id`, `codigo`, `descripcion`, `created_at`, `updated_at`) VALUES
	(1, 1, '1.1.a', 'Desarrollar las capacidades de empleabilidad y autoempleo, acceso a financiamiento; así como acompañamiento en la comercialización, desarrollo de emprendimientos con énfasis en personas en situación de pobreza y pobreza extrema.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(2, 1, '1.1.b', 'Fortalecer la cobertura del Programa de Transferencias Monetarias no contributivas en provincias con alta incidencia de pobreza y pobreza extrema.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(3, 1, '1.1.c', 'Promover la asistencia técnica para la inclusión económica de actores de la economía popular y solidaria.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(4, 2, '1.2.a', 'Potenciar los programas y servicios de protección especial de cuidado y atención integral a las personas y grupos de atención prioritaria.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(5, 2, '1.2.b', 'Fortalecer la capacidad técnica, equipamiento e infraestructura para los programas y servicios de protección especial, de cuidado y atención integral a las personas y grupos de atención prioritaria.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(6, 2, '1.2.c', 'Implementar programas y proyectos que fortalezcan el tejido social y a la familia como el espacio natural y fundamental para el desarrollo integral del niño, niña y adolescente.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(7, 3, '1.3.a', 'Fortalecer prácticas de vida saludable que promuevan la salud en un ambiente y entorno sostenible, seguro e inclusivo; con enfoques de derechos, intercultural, intergeneracional, de participación social y de género.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(8, 3, '1.3.b', 'Promover la formación académica continua de los profesionales de la salud.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(9, 3, '1.3.c', 'Incrementar el acceso oportuno a los servicios de salud, con énfasis en la atención a grupos prioritarios, a través de la provisión de medicamentos e insumos y el mejoramiento del equipamiento e infraestructura del Sistema Nacional de Salud.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(10, 4, '1.4.a', 'Mejorar las acciones para la prevención, diagnóstico y tratamiento oportuno de enfermedades transmisibles, con énfasis en el control y atención de infecciones de transmisión sexual y el VIH/SIDA.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(11, 4, '1.4.b', 'Fortalecer acciones para la prevención, diagnóstico y tratamiento oportuno de enfermedades no transmisibles, con énfasis en el control y atención integral del cáncer.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(12, 4, '1.4.c', 'Fortalecer el modelo comunitario de salud mental, con abordaje de prevención y rehabilitación.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(13, 5, '1.5.a', 'Mejorar la calidad de la atención en salud materna y salud sexual y reproductiva, abordando las desigualdades en el acceso a los servicios.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(14, 5, '1.5.b', 'Fortalecer el acceso al paquete de servicios para garantizar la atención integral en educación y salud sexual y salud reproductiva.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(15, 5, '1.5.c', 'Implementar acciones de promoción de la salud para prevenir el embarazo en niñas y adolescentes.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(16, 6, '1.6.a', 'Promover el acceso a espacios públicos seguros e inclusivos para el disfrute del tiempo libre, el desarrollo personal, la cohesión social, y la salud mental y física.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(17, 6, '1.6.b', 'Implementar el plan de mantenimiento de las instalaciones deportivas administradas por el Ministerio del Deporte, promoviendo la accesibilidad universal en los espacios públicos.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(18, 7, '1.7.a', 'Ampliar la cobertura de servicios integrales para la primera infancia en zonas priorizadas para brindar el paquete priorizado de forma oportuna, con calidad y con un enfoque de equidad.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(19, 7, '1.7.b', 'Generar intervenciones articuladas y coordinadas con las instituciones del Estado que aseguren la entrega de bienes y servicios para reducir la desnutrición crónica infantil, con enfoque territorial y de derechos.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(20, 7, '1.7.c', 'Fortalecer las estrategias público-privadas para actuar frente a los determinantes de la salud en la primera infancia, fomentando la participación ciudadana y la articulación con las entidades gubernamentales locales y del sector privado.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(21, 8, '1.8.a', 'Mejorar el acceso de la vivienda y las condiciones de habitabilidad de la población urbana y rural con énfasis en las personas de bajos ingresos y grupos prioritarios, garantizando la sostenibilidad y condiciones de vida a nivel nacional.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(22, 8, '1.8.b', 'Formular normativa técnica de gestión de hábitat, el espacio público, el desarrollo de asentamientos humanos e implementar las acciones que garanticen el derecho a un hábitat inclusivo, seguro, resiliente y sostenible a nivel nacional.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(23, 8, '1.8.c', 'Direccionar, articular y promover la implementación de instrumentos, normativas y herramientas para fomentar el uso y gestión del suelo, los catastros; así como, la asistencia técnica en la gestión territorial a nivel nacional.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(24, 9, '1.9.a', 'Fomentar y proteger las identidades y diversidades culturales de Pueblos y Nacionalidades.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(25, 9, '1.9.b', 'Incidir en la gestión de las políticas públicas para la inclusión social de pueblos y nacionalidades a través de la implementación de la Agenda Nacional para la Igualdad de Pueblos y Nacionalidades, orientado a la reducción de la pobreza multidimensional.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(26, 9, '1.9.c', 'Identificar proyectos en territorios transfronterizos de pueblos binacionales el marco del Memorando de Entendimiento de Cooperación Internacional entre Colombia y Ecuador.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(27, 10, '1.10.a', 'Financiar proyectos sociales, económicos y productivos, fortaleciendo las cadenas de valor para mejorar las condiciones de vida de los Pueblos y Nacionalidades.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(28, 10, '1.10.b', 'Brindar asistencia técnica, capacitación para la ejecución de proyectos productivos sostenibles; y, asistencia humanitaria a pueblos y nacionalidades en condiciones de riesgo.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(29, 10, '1.10.c', 'Implementar el sistema de registro comunas, comunidades pueblos y nacionalidades de las organizaciones sociales para su fortalecimiento y ejercicio de los derechos colectivos.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(30, 11, '2.1.a', 'Generar instrumentos normativos y técnicos que promuevan el acceso al sistema educativo.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(31, 11, '2.1.b', 'Dotar de infraestructura física, recursos y talento humano a las instituciones educativas públicas a nivel nacional.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(32, 11, '2.1.c', 'Fortalecer la oferta educativa en modalidades flexibles e innovadoras que atiendan las necesidades contextualizadas de los territorios con la participación de las comunidades.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(33, 12, '2.2.a', 'Innovar el currículo nacional, planes de estudio, gestión pedagógica, evaluación de aprendizajes y recursos educativos; para la transición de una lógica contenidista a un proceso de desarrollo que construya una ciudadanía competente, con pertinencia intercultural, local y global; acompañados de procesos sostenibles de formación y capacitación contextualizada de los profesionales de la educación para su revalorización.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(34, 12, '2.2.b', 'Potenciar entornos educativos seguros e inclusivos, libres de toda forma de discriminación y violencia.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(35, 12, '2.2.c', 'Mejorar la calidad de la formación del bachillerato técnico y del bachillerato científico – humanístico vinculada con la vocación productiva de los territorios y los proyectos de vida del estudiantado.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(36, 12, '2.2.d', 'Mejorar el sistema de nivelación, garantizando la permanencia de los estudiantes y evitando la deserción en el sistema de educación.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(37, 13, '2.3.a', 'Articular el desarrollo de programas y proyectos a la gestión pública de los otros organismos públicos del Sistema de Educación Superior para trabajar en conjunto en el aseguramiento de la calidad, a nivel institucional, de carreras y programas profesionalizantes.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(38, 13, '2.3.b', 'Ampliar la capacidad de oferta del Sistema de Educación Superior a nivel nacional a través de la dotación de infraestructura, talento humano y la capacidad operativa necesaria de manera sostenible.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(39, 13, '2.3.c', 'Fortalecer el proceso y la política de becas, créditos educativos y ayudas económicas, que permita a los estudiantes ingresar a la educación superior, priorizando los grupos históricamente excluidos.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(40, 14, '2.4.a', 'Impulsar la educación superior a través del acceso a la tecnología mediante la coordinación interinstitucional considerando niveles de cobertura y enfoques de igualdad.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(41, 14, '2.4.b', 'Desarrollar carreras en áreas estratégicas para la investigación científica, ingenierías, matemáticas (STEM) con base en la innovación como motor del cambio productivo y tecnológico nacional.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(42, 14, '2.4.c', 'Generar espacios de diálogo para la construcción de acuerdos entre el sector público y privado para impulsar las carreras en modalidad dual.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(43, 15, '2.5.a', 'Implementar programas de capacitación al personal académico en innovaciones tecnológicas, tomando en cuenta las zonas geográficas y temáticas aplicables.', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(44, 15, '2.5.b', 'Ejecutar programas para el apoyo de la investigación científica, innovación y transferencia de tecnología con parámetros de responsabilidad y enfoques equitativo e intercultural.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(45, 15, '2.5.c', 'Desarrollar redes y espacios abiertos de conocimiento por medio de la investigación científica, la innovación, la transferencia de la tecnología y la vinculación con la sociedad.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(46, 16, '2.6.a', 'Diseñar proyectos para el mejoramiento de la infraestructura cultural y patrimonial, con énfasis en los repositorios del Ministerio de Cultura y Patrimonio, contenedores de la Colección Nacional (archivos, bibliotecas y museos), para la conservación adecuada de sus bienes, su investigación y difusión.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(47, 16, '2.6.b', 'Promover la cooperación interinstitucional para la conservación, salvaguarda y desarrollo del patrimonio material e inmaterial, para los distintos niveles de gobierno y la ciudadanía en general.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(48, 16, '2.6.c', 'Incentivar la creación, circulación y acceso a bienes y servicios culturales, para el fortalecimiento de las identidades culturales desde el enfoque de derechos.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(49, 17, '2.7.a', 'Financiar proyectos artísticos y culturales a nivel nacional, priorizando las provincias con altos niveles de violencia e inseguridad.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(50, 17, '2.7.b', 'Promover la difusión y comercialización de bienes y servicios artísticos y culturales en espacios nacionales e internacionales.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(51, 17, '2.7.c', 'Incentivar la articulación público – privada para el financiamiento de procesos culturales.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(52, 18, '2.8.a', 'Reforzar la atención médica y técnica para los deportistas de alto rendimiento.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(53, 18, '2.8.b', 'Priorizar deportes y deportistas con miras a Juegos Olímpicos y Paralímpicos.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(54, 19, '3.1.a', 'Prevenir el reclutamiento de niñas, niños y adolescentes, por parte de grupos delictivos organizados, promocionando factores de protección en entornos influenciados por el delito y la violencia.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(55, 19, '3.1.b', 'Contener y disminuir los delitos de oportunidad, principalmente el secuestro, extorsión, como los delitos cibernéticos, la trata de personas y el tráfico ilícito de migrantes, con base a la investigación técnica especializada.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(56, 19, '3.1.c', 'Integrar a la comunidad en la recuperación del territorio captado por grupos de delincuencia organizada y mercados ilegales generadores de violencia criminal, promoviendo la participación ciudadana.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(57, 20, '3.2.a', 'Dotar a las Instituciones del Sector Seguridad con el equipamiento y medios logísticos necesarios para el cumplimiento de su misión institucional, en favor del fortalecimiento de la seguridad ciudadana, el orden público y protección interna.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(58, 20, '3.2.b', 'Intervenir los territorios afectados por mercados ilícitos, sus cadenas de valor y actores criminales, fortaleciendo la detección, interdicción, desarticulación y denegación de recursos, capacidades, redes de abastecimiento y logística, utilidades ilícitas y de financiamiento de la delincuencia organizada y el terrorismo.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(59, 20, '3.2.c', 'Fortalecer el control migratorio integral, los mecanismos de control del sistema financiero y actividades económicas vulnerables para prevenir y detectar el lavado de activos, flujos ilícitos y economías ilegales, provenientes del narcotráfico, la minería ilegal, y otros delitos de altos impacto.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(60, 21, '3.3.a', 'Optimizar las capacidades de la defensa para garantizar la soberanía, integridad territorial enfrentando las amenazas y riesgos.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(61, 21, '3.3.b', 'Incrementar la participación del sector defensa en representaciones militares en el exterior, misiones de paz y ejercicios militares en el contexto internacional mediante acciones de cooperación.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(62, 22, '3.4.a', 'Ejecutar programas y proyectos de cooperación y asistencia con otras instituciones del Estado, para contribuir a la seguridad integral en beneficio de la sociedad.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(63, 22, '3.4.b', 'Optimizar la Investigación, Desarrollo, Innovación y Producción en el sector Defensa.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(64, 22, '3.4.c', 'Fortalecer las relaciones cívico-militares para posicionar en la ciudadanía la importancia de la Defensa y la Seguridad Multidimensional.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(65, 23, '3.5.a', 'Incrementar la calidad del servicio de atención a la comunidad migrante mediante procesos de simplificación, accesibilidad y calidez.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(66, 23, '3.5.b', 'Implementar programas de transformación digital de los servicios para beneficio de las personas en situación de movilidad humana.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(67, 23, '3.5.c', 'Ejecutar programas de integración, inclusión social y fortalecimiento de capacidades para migrantes ecuatorianos y personas en condiciones de movilidad humana.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(68, 24, '3.6.a', 'Identificar, monitorear y alertar de forma permanente y oportuna sobre amenazas y riesgos a la seguridad integral del Estado.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(69, 24, '3.6.b', 'Producir Inteligencia Estratégica que aporte a la seguridad integral del Estado.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(70, 24, '3.6.c', 'Fortalecer las capacidades técnicas y tecnológicas para producir ciberinteligencia.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(71, 25, '3.7.a', 'Concientizar a las autoridades, funciones del Estado, gobiernos autónomos descentralizados, sociedad civil y academia sobre el rol de la actividad de inteligencia.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(72, 25, '3.7.b', 'Fortalecer la cooperación internacional que aporte a la implementación de la estrategia de cultura de inteligencia.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(73, 25, '3.7.c', 'Promover acuerdos interinstitucionales de intercambio de información en todos los niveles del estado.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(74, 26, '3.8.a', 'Proveer y mantener de medios tecnológicos de seguridad y vigilancia penitenciaria, equipamiento de protección de los servidores del Cuerpo de Seguridad y Vigilancia Penitenciaria, e infraestructura penitenciaria.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(75, 26, '3.8.b', 'Formar y capacitar a los servidores del Cuerpo de Seguridad y Vigilancia Penitenciaria en el marco de los derechos humanos y la seguridad penitenciaria.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(76, 26, '3.8.c', 'Prevenir y mitigar eventos que pongan en riesgo la seguridad de los Centros de Privación de la Libertad, personas privadas de libertad y funcionarios del Sistema Nacional de Rehabilitación Social y medidas socioeducativas, a través del desarrollo de inteligencia penitenciaria.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(77, 27, '3.9.a', 'Clasificar a las personas privadas de libertad bajo parámetros de peligrosidad que permita adecuar y fortalecer los procesos de diagnóstico y rehabilitación por medio de la ejecución de los ejes de tratamiento.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(78, 27, '3.9.b', 'Garantizar el acceso oportuno a beneficios penitenciarios, cambios de régimen, indultos y repatriaciones en cumplimiento a la normativa legal vigente en todo el territorio nacional.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(79, 27, '3.9.c', 'Fortalecer las habilidades y competencias laborales y sociales en cumplimiento de los ejes de tratamiento por medio de la cooperación, especialmente con instituciones del Directorio del Organismo Técnico de rehabilitación social e instituciones educativas avaladas por el ente rector de la educación superior.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(80, 28, '3.10.a', 'Promover la participación activa de la comunidad en la identificación, reducción de riesgos locales y preparación ante desastres.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(81, 29, '3.11.a', 'Desarrollar programas educativos y de capacitación que mejoren la conciencia y el conocimiento de los riesgos existentes, así como las medidas de prevención y respuestas adecuadas.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(82, 30, '3.12.a', 'Gestionar las incidencias o vulnerabilidades de ciberseguridad presentadas en los servicios de telecomunicaciones.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(83, 30, '3.12.b', 'Implementar programas de educación y concientización en ciberseguridad dirigidos a la población en general, empresas y funcionarios públicos, mejorando las habilidades digitales de la población.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(84, 31, '3.13.a', 'Impulsar programas de sensibilización y educación en materia de derechos humanos para los funcionarios de las entidades públicas de la Función Ejecutiva.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(85, 31, '3.13.b', 'Establecer medidas de garantía para no repetición, reparación y promoción de derechos humanos a ser implementadas por las entidades públicas de la Función Ejecutiva.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(86, 32, '3.14.a', 'Fortalecer los mecanismos gestionados por la institución en materia de prevención y atención integral ante la violencia contra mujeres, niños, niñas y adolescentes.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(87, 32, '3.14.b', 'Promover la no discriminación y la igualdad de oportunidades para las personas LGBTIQ+, mediante programas de sensibilización referentes a orientación sexual y diversidad sexogenérica.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(88, 33, '3.15.a', 'Mejorar el sistema de audiencias y despacho de causas.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(89, 33, '3.15.b', 'Implementar tecnologías y procesos que optimicen la gestión de casos, reduzcan los tiempos de espera y mejoren la calidad de las decisiones judiciales.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(90, 33, '3.15.c', 'Establecer mecanismos de control interno y externo para supervisar el cumplimiento de las normas de transparencia, integridad y eficiencia en la Función Judicial.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(91, 34, '3.16.a', 'Dotar de defensores públicos para la prestación del servicio a nivel nacional.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(92, 34, '3.16.b', 'Dotar de infraestructura, equipamiento y mobiliario a nivel nacional para la Defensoría Pública.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(93, 35, '4.1.a', 'Negociar y suscribir instrumentos y acuerdos internacionales.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(94, 35, '4.1.b', 'Generar espacios de promoción de la oferta cultural, turística y patrimonial del país.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(95, 36, '4.2.a', 'Negociar, suscribir e implementar acuerdos comerciales para impulsar la agenda comercial del país.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(96, 36, '4.2.b', 'Diversificar la oferta exportable de bienes y servicios no petroleros en mercados actuales y potenciales.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(97, 36, '4.2.c', 'Fortalecer la participación de Ecuador en los sistemas de integración regional y sistema multilateral de comercio.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(98, 37, '4.3.a', 'Robustecer el marco institucional y normativo para la atracción, promoción y facilitación de las inversiones, brindándoles estabilidad jurídica.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(99, 37, '4.3.b', 'Establecer e implementar acciones coordinadas para la promoción y atracción de inversiones locales y extranjeras que permitan efectiva concreción de inversión.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(100, 37, '4.3.c', 'Facilitar procesos de gestión y concreción de la inversión nacional y extranjera.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(101, 38, '4.4.a', 'Elaborar normativa que fortalezca controles sobre los tipos de regímenes de contratación.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(102, 38, '4.4.b', 'Capacitar a entidades y proveedores respecto a los usos de procesos competitivos de contratación.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(103, 38, '4.4.c', 'Fortalecer los mecanismos de control del Servicio Nacional de Contratación Pública.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(104, 39, '4.5.a', 'Elaborar normativa que promueva la sostenibilidad en los procesos de contratación.', '2026-08-25 07:25:28', '2026-08-25 07:25:28'),
	(105, 39, '4.5.b', 'Promover el fortalecimiento institucional en términos de control y capacidades de oferentes y demandantes.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(106, 40, '4.6.a', 'Incrementar la recaudación tributaria y disponer de mayores ingresos permanentes para el Presupuesto General del Estado.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(107, 41, '4.7.a', 'Gestionar la deuda pública de forma eficiente y sostenible para mantener niveles de deuda coherentes con las reglas fiscales.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(108, 41, '4.7.b', 'Diversificar fuentes de financiamiento e implementar mecanismos financieros sostenibles e innovadores.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(109, 41, '4.7.c', 'Mejorar los mecanismos para promover la calidad del gasto y la vinculación planificación-presupuesto.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(110, 42, '4.8.a', 'Construir instrumentos normativos sustentados en investigaciones y propuestas técnicas de información económica.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(111, 42, '4.8.b', 'Promover mecanismos que faciliten el acceso a crédito para sectores clave de la economía.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(112, 42, '4.8.c', 'Ampliar las herramientas de regulación y supervisión de la actividad financiera del país para aumentar la resiliencia del sistema financiero.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(113, 43, '4.9.a', 'Fortalecer las capacidades institucionales del Estado para potenciar la identificación, priorización y estructuración de un portafolio de proyectos de Asociaciones Público-Privadas de infraestructura pública.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(114, 43, '4.9.b', 'Fortalecer la cooperación y servicios al inversionista en materia de Asociaciones Público Privadas para ampliar y priorizar el portafolio de proyectos Asociaciones Público-Privadas.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(115, 43, '4.9.c', 'Diseñar instrumentos que permitan la identificación de posibles soluciones de nudos críticos, y la priorización y estructuración de proyectos y contratos en materia de Asociaciones Público – Privadas.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(116, 44, '5.1.a', 'Desarrollar capacidades productivas y empresariales de los productores y organizaciones de productores con acompañamiento integral y multidimensional hacia modelos de agricultura sostenible.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(117, 44, '5.1.b', 'Generar mecanismos de comercialización que faciliten el acceso a mercados a través de la diversificación de productos de calidad y espacios con intermediación controlada.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(118, 44, '5.1.c', 'Implementar estándares nacionales e internacionales para mejorar las prácticas de sanidad agropecuaria y reformar la tecnificación y profesionalización de los organismos competentes.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(119, 45, '5.2.a', 'Dotar de infraestructura, riego, legalización de la tenencia de la tierra, asistencia técnica y capacitación, e investigación para la mejora genética agrícola, pecuaria y forestal.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(120, 45, '5.2.b', 'Desarrollar la práctica y mejora productiva de forma diversificada, sostenible y resiliente, que incluyan buenas prácticas agropecuarias, interculturales, preserven la biodiversidad e incrementen la participación de jóvenes y mujeres.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(121, 45, '5.2.c', 'Facilitar el acceso a financiamiento y aseguramiento agropecuario especializado en función del tipo de cultivo y actividades innovadoras.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(122, 46, '5.3.a', 'Potenciar la producción acuícola y pesquera, a través del fomento de la piscicultura y maricultura en el Ecuador.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(123, 46, '5.3.b', 'Fortalecer las capacidades, líneas de investigación científico-técnica de acuicultura y pesca orientada al desarrollo de técnicas sostenibles y sustentables que se articulen al sector productivo.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(124, 46, '5.3.c', 'Fortalecer el desarrollo organizacional y productivo del sector acuícola de pequeña escala y al sector pesquero artesanal.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(125, 46, '5.3.d', 'Implementar mecanismos de control laboral y pesquero que incentiven la formalidad y reduzcan la pesca ilegal no declarada y no reglamentada.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(126, 47, '5.4.a', 'Ampliar la conectividad de los sectores turísticos locales.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(127, 47, '5.4.b', 'Incrementar y diversificar la oferta de servicios turísticos, su competitividad y calidad de acuerdo con la demanda local e internacional, la integralidad territorial de los destinos, y con la participación coordinada de los actores del sector turístico.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(128, 48, '5.5.a', 'Promover el manejo eficiente de recursos naturales y el uso de tecnologías limpias para diversificar la producción e incorporar nuevos productos.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(129, 48, '5.5.b', 'Fortalecer procesos que permitan la diversificación y calidad de las cadenas productivas.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(130, 48, '5.5.c', 'Elaborar la Estrategia de Agronegocios Sostenibles e implementar la Estrategia Nacional de Calidad y de Economía Circular.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(131, 48, '5.5.d', 'Fortalecer la asociatividad, y el acceso a servicios financieros y no financieros en circuitos de economía popular y solidaria.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(132, 49, '6.1.a', 'Fortalecer los incentivos, controles y marco normativo para promover la inclusión laboral en condiciones dignas en todo el territorio nacional.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(133, 49, '6.1.b', 'Fortalecer las acciones de control a las partes involucradas para verificar el cumplimiento de los derechos laborales.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(134, 50, '6.2.a', 'Ampliar los programas de mejoramiento continuo para las micro, pequeñas y medianas empresas (MIPYMES).', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(135, 51, '6.3.a', 'Fomentar el desarrollo de iniciativas clústeres como herramienta de colaboración público-privada enfocada en resolver problemas de las cadenas productivas para la generación de empleo.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(136, 51, '6.3.b', 'Promover zonas francas potenciando las vocaciones productivas de cada zona y de esta forma fomentar el empleo local.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(137, 52, '6.4.a', 'Ofrecer programas de capacitación y de fortalecimiento de competencias laborales que permitan a los jóvenes ampliar sus oportunidades en el mercado laboral.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(138, 52, '6.4.b', 'Implementar programas y proyectos e incentivos fiscales en aplicación a la Ley de Eficiencia Económica y Generación de Empleo.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(139, 53, '6.5.a', 'Implementar normativa secundaria para reforzar el cumplimiento de obligaciones sobre retribución económica entre hombres y mujeres por un trabajo de igual valor.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(140, 54, '7.1.a', 'Suministrar energía eléctrica con enfoque de largo plazo, promoviendo el uso sostenible de recursos renovables, autogeneración con venta de excedentes, generación distribuida y sistemas de almacenamiento; así como, la participación de empresas públicas e inversiones privadas.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(141, 54, '7.1.b', 'Planificar integralmente la expansión y operación óptima de los sistemas de distribución de energía eléctrica y del sistema de alumbrado público general, que responda a las necesidades de desarrollo del sector con eficiencia, calidad y resiliencia, para el corto, mediano y largo plazo.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(142, 54, '7.1.c', 'Optimizar el uso y consumo energético en toda la cadena de suministro y en los usuarios finales, fortaleciendo el marco normativo e institucional, gestión de la energía, innovación tecnológica, aplicación de incentivos, uso de tecnologías y equipos con estándares mínimos de rendimiento energético y difusión de mejores prácticas.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(143, 55, '7.2.a', 'Impulsar el desarrollo de proyectos de inversión pública y privada; así como, el uso de tecnologías sostenibles en la cadena de valor del sector de hidrocarburos, fortaleciendo el marco legal que permita su ejecución.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(144, 56, '7.3.a', 'Desarrollar el sector minero promocionando la captación de inversión nacional y extranjera con enfoque ambiental y fortaleciendo el marco normativo para la administración, regulación y control del Estado a las actividades mineras.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(145, 57, '7.4.a', 'Promover la conservación, restauración, protección, uso y aprovechamiento sostenible del patrimonio natural, con mecanismos y medios regulatorios establecidos para su gestión.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(146, 57, '7.4.b', 'Fomentar la gestión del cambio climático con acciones en territorio en los componentes de adaptación, mitigación y producción; y, desarrollo sostenible dentro de los sectores priorizados.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(147, 57, '7.4.c', 'Promover los modelos circulares que contribuyan a la reducción de la contaminación de los recursos naturales e hídricos.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(148, 58, '7.5.a', 'Articular medidas de adaptación al cambio climático, considerando los criterios de sostenibilidad, en coordinación con los actores competentes, y aportando desde la reducción de riesgos de desastres.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(149, 58, '7.5.b', 'Promover la gestión de riesgos de desastres asociados a factores climáticos, ambientales, geológicos, oceánicos, hidrometeorológicos y factores antrópicos.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(150, 59, '7.6.a', 'Fomentar la implementación de normas y estándares de construcciones resilientes y sostenibles en infraestructuras nuevas y existentes.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(151, 60, '7.7.a', 'Impulsar la gestión integral, integrada y sostenible del recurso hídrico, en todos sus usos y aprovechamientos, con la identificación y establecimiento de garantías preventivas y formas de conservación del dominio hídrico público.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(152, 60, '7.7.b', 'Fomentar la implementación y ampliación de sistemas de aprovechamiento de agua para su potabilización, drenaje y saneamiento, y uso en riego.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(153, 61, '8.1.a', 'Incrementar la cobertura de la tecnología 4G en el territorio nacional.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(154, 61, '8.1.b', 'Aumentar la cobertura de fibra óptica en el país.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(155, 62, '8.2.a', 'Promover procesos permanentes de formación y control, bajo una cultura de movilidad segura para reducir la siniestralidad a nivel nacional.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(156, 62, '8.2.b', 'Garantizar la Seguridad Operacional del transporte aéreo con la finalidad de evitar incidentes y accidentes.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(157, 62, '8.2.c', 'Promover un modelo de gestión sostenible que permita mantener el buen estado de la infraestructura y la calidad de los servicios de transporte multimodal, optimizando la capacidad instalada en función de las necesidades ciudadanas y del mercado, a través de proyectos públicos y privados.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(158, 63, '9.1.a', 'Desarrollar espacios de participación y control social que permitan una formulación, seguimiento y evaluación eficiente de los procesos de las instituciones públicas.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(159, 63, '9.1.b', 'Generar alianzas estratégicas con diversos niveles de gobierno, para fortalecer la gestión de las delegaciones provinciales.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(160, 63, '9.1.c', 'Desarrollar mecanismos que permitan incrementar la participación ciudadana activa de los pueblos y nacionalidades; y, grupos prioritarios.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(161, 63, '9.1.d', 'Diseñar e implementar mecanismos de evaluación ciudadana en la gestión pública de las instituciones y los sujetos obligados a rendir cuentas.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(162, 64, '9.2.a', 'Implementar el modelo de Estado abierto a través del Plan de Acción de Gobierno Abierto e impulsar la adhesión de instituciones a este modelo de gestión.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(163, 64, '9.2.b', 'Fortalecer la transparencia mediante el acceso a información oportuna a toda la ciudadanía.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(164, 65, '9.3.a', 'Incrementar el análisis en simplificación regulatoria, proponer reformas normativas e identificar procesos derivados de este análisis para su optimización.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(165, 65, '9.3.b', 'Desarrollar propuesta de alineamiento estratégico y la implementación de metodologías de innovación pública en materia de simplificación de procesos administrativos para la mejora regulatoria.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(166, 66, '9.4.a', 'Estandarizar instrumentos para la identificación, prevención y gestión de conflictos en la Función Ejecutiva.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(167, 66, '9.4.b', 'Establecer canales de comunicación efectiva que permitan a los funcionarios gubernamentales y a las partes interesadas reportar posibles conflictos.', '2026-08-25 07:25:29', '2026-08-25 07:25:29'),
	(168, 67, '9.5.a', 'Promover la conformación de los Consejos Ciudadanos Sectoriales en la Función Ejecutiva, a través de socialización y asistencia técnica con los ministerios sectoriales.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(169, 67, '9.5.b', 'Fortalecer el funcionamiento de los Consejos Ciudadanos Sectoriales en la Función Ejecutiva, a través de la coordinación interinstitucional, el seguimiento y la resolución de nudos críticos con las entidades rectoras.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(170, 68, '9.6.a', 'Mejorar los procesos de gestión institucional a través de la innovación de las estructuras orgánicas, para brindar servicios de calidad y satisfacer las demandas ciudadanas.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(171, 69, '9.7.a', 'Fortalecer, ampliar y articular los programas de cooperación internacional vigentes.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(172, 69, '9.7.b', 'Implementar estrategias de identificación y de acercamiento a nuevas fuentes de cooperación bilateral, multilateral y no gubernamental.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(173, 69, '9.7.c', 'Fortalecer la institucionalidad de la cooperación internacional y el trabajo de coordinación interinstitucional.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(174, 70, '9.8.a', 'Ampliar la implementación de metodologías de riesgos institucionales de corrupción en las entidades públicas.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(175, 70, '9.8.b', 'Desarrollar propuestas de mejora de procesos y estructura institucional para mitigar los riesgos de corrupción en instituciones y procesos priorizados.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(176, 70, '9.8.c', 'Formular y consolidar metodologías de investigación e impulso jurídico de los casos que hayan generado corrupción, afectación de los derechos de la ciudadanía o el interés social en la gestión pública.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(177, 71, '10.1.a', 'Adecuar la normativa y los lineamientos técnicos acorde con la Ley Orgánica de Gestión Integral de Riesgo de Desastre.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(178, 71, '10.1.b', 'Ampliar la cobertura y mejorar la eficacia de los sistemas de alerta temprana, mapeo y monitoreo de amenazas, para proteger a la población mediante la adopción de medidas de respuesta oportunas y efectivas.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(179, 71, '10.1.c', 'Implementar mecanismos de respuesta ante desastres y de recuperación post desastre velando por la protección de los derechos de las personas afectadas y de la naturaleza.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(180, 71, '10.1.d', 'Capacitar y equipar al voluntariado de protección civil y a los actores nacionales y locales para que puedan asistir a la población ante emergencias y desastres de forma segura considerando las particularidades y necesidades del territorio.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(181, 71, '10.1.e', 'Fortalecer las capacidades de primera respuesta, respuesta humanitaria y logística para la atención de desastres en todos los niveles.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(182, 71, '10.1.f', 'Adoptar medidas integrales de recuperación post-desastre basadas en la evaluación de los efectos e impactos del desastre y/o emergencia en todos los niveles territoriales.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(183, 71, '10.1.g', 'Diseñar e implementar mecanismos de gestión financiera y técnica para la gestión integral del riesgo de desastres.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(184, 72, '10.2.a', 'Desarrollar e implementar programas y proyectos de investigación, de vinculación con la comunidad e iniciativas de participación ciudadana para comprender, anticipar y monitorear los riesgos de desastres a nivel nacional.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(185, 72, '10.2.b', 'Revisar la aplicación o expedición de normas técnicas y/o ordenanzas para la gestión de riesgos en los GAD municipales.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(186, 72, '10.2.c', 'Fomentar el desarrollo de ejercicios de simulación y simulacros de las principales amenazas existentes en el territorio.', '2026-08-25 07:25:30', '2026-08-25 07:25:30');

-- Volcando estructura para tabla sipeip.pnd_metas
DROP TABLE IF EXISTS `pnd_metas`;
CREATE TABLE IF NOT EXISTS `pnd_metas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pnd_objetivo_id` bigint unsigned NOT NULL,
  `numero` smallint unsigned NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pnd_metas_objetivo_numero_unique` (`pnd_objetivo_id`,`numero`),
  CONSTRAINT `pnd_metas_pnd_objetivo_id_foreign` FOREIGN KEY (`pnd_objetivo_id`) REFERENCES `pnd_objetivos` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.pnd_metas: ~107 rows (aproximadamente)
INSERT INTO `pnd_metas` (`id`, `pnd_objetivo_id`, `numero`, `descripcion`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Reducir la tasa de pobreza extrema por ingresos del 9,81% en el año 2023 a 9,12% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(2, 1, 2, 'Reducir la tasa de pobreza por necesidades básicas insatisfechas del 30,84% en el año 2023 al 30,11% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(3, 1, 3, 'Reducir la razón de mortalidad materna de 33,90 en el año 2022 a 33,77 al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(4, 1, 4, 'Reducir la prevalencia de Desnutrición Crónica Infantil en menores de dos años del 20,1% en 2022-2023 a 18,7% en 2024-2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(5, 1, 5, 'Reducir la tasa específica de nacimientos en mujeres adolescentes de 10 a 14 años de 2,43 en el año 2022 a 2,40 al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(6, 1, 6, 'Reducir la tasa específica de nacimientos en mujeres adolescentes de 15 a 19 años de 47,51 en el año 2022 a 47,40 al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(7, 1, 7, 'Incrementar la cobertura de vacunación de Rotavirus de 85,66% en el año 2022 a 86,32% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(8, 1, 8, 'Incrementar la cobertura de vacunación de SRP (Sarampión, Rubeola, Parodititis) de 71,50% en el año 2022 a 71,69% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(9, 1, 9, 'Incrementar la cobertura de vacunación de Neumococo de 85,66% en el año 2022 a 85,78% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(10, 1, 10, 'Incrementar el porcentaje de personas que viven con VIH que conocen su estado serológico y se encuentran en tratamiento antirretroviral de 84,9% en el año 2023 a 87,42% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(11, 1, 11, 'Reducir la tasa de mortalidad por suicidio de 6,48 en el año 2022 a 6,31 al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(12, 1, 12, 'Reducir el gasto de bolsillo en salud como porcentaje del gasto total en salud de 32,59% en el año 2022 a 31,27% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(13, 1, 13, 'Incrementar la tasa de médicos familiares en atención primaria de 1,00 en el año 2020 a 1,70 al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(14, 1, 14, 'Reducir el déficit habitacional de vivienda de 56,71% en el año 2022 a 56,41% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(15, 2, 1, 'Incrementar el porcentaje de estudiantes del subnivel básica superior que han alcanzado o superado el nivel mínimo de competencia en el campo de Lengua y Literatura en la evaluación Ser Estudiante de 46,90% en el año 2022 a 47,80% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(16, 2, 2, 'Incrementar la tasa neta de matrícula de educación inicial de 56,63% en el año 2022 a 60,65% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(17, 2, 3, 'Incrementar la tasa neta de matrícula de Educación General Básica de 93,63% en el año 2022 a 97,54% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(18, 2, 4, 'Incrementar la tasa neta de Bachillerato de 70,35% en el año 2022 a 71,39% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(19, 2, 5, 'Incrementar el porcentaje de personas de 18 a 29 años de edad con bachillerato completo de 75,30% en el año 2021 a 79,32% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(20, 2, 6, 'Incrementar el porcentaje de Instituciones del Sistema de Educación Intercultural Bilingüe en los que se implementa el MOSEIB de 4,61% en el año 2022 a 15,12% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(21, 2, 7, 'Incrementar el porcentaje de Instituciones Educativas del sostenimiento fiscal con cobertura de internet con fines pedagógicos de 51,75% en el año 2022 a 61,20% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(22, 2, 8, 'Incrementar el número de becas y ayudas económicas adjudicadas para estudios de educación superior de 20.195 en el año 2023 a 28.696 al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(23, 2, 9, 'Incrementar la tasa bruta de matrícula en educación superior terciaria del 40,33% en el año 2022 al 45,54% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(24, 2, 10, 'Disminuir la tasa de deserción de primer año en tercer nivel de grado del 20,98% en el año 2021 a 17,99% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(25, 2, 11, 'Incrementar el número de personas tituladas de educación superior técnica y tecnológica de 44.674 en el año 2022 a 60.404 al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(26, 2, 12, 'Incrementar los artículos publicados por las universidades y escuelas politécnicas en revistas indexadas de 13.777 en el año 2022 a 16.727 al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(27, 2, 13, 'Incrementar los investigadores por cada mil integrantes de la Población Económicamente Activa de 0,63 en el año 2022 a 0,75 al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(28, 2, 14, 'Incrementar el número de obras, proyectos y producciones artísticas y culturales con presencia en espacios internacionales, financiados con fondos de fomento no reembolsable de la convocatoria de movilidad internacional de 109 en el año 2023 a 132 al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(29, 2, 15, 'Incrementar el monto de inversión privada destinada al sector artístico, cultural y patrimonial mediante incentivos tributarios culturales de 3,6 millones en el año 2023 a 4,0 millones al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(30, 2, 16, 'Mantener el número de medallas que se obtendrán en el ciclo Olímpico, Paralímpico y Sordolímpico en 148 al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(31, 3, 1, 'Reducir la tasa de homicidios intencionales por cada 100 mil habitantes de 45,11 en el año 2023 a 39,11 al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(32, 3, 2, 'Reducir la tasa de femicidios por cada 100.000 mujeres de 1,14 en el año 2023 a 0,8 al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(33, 3, 3, 'Incrementar el porcentaje de víctimas de violencia sexual detectados o cometidos en el ámbito educativo y que recibieron plan de acompañamiento anual de 91,62% en el año 2023 a 95,00% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(34, 3, 4, 'Incrementar el porcentaje de incidentes y/o vulnerabilidades de ciberseguridad gestionadas con los prestadores de servicios de telecomunicaciones de 85,38% en el año 2023 a 95,00% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(35, 3, 5, 'Aumentar el porcentaje de afectación de las estructuras de delincuencia organizada de 0% en el año 2023 a 85% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(36, 3, 6, 'Incrementar la contribución militar en la seguridad integral de 33,64% en el año 2023 a 39,67% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(37, 3, 7, 'Incrementar el porcentaje de ataques armados neutralizados que atenten la soberanía del territorio nacional de 50,00% en el año 2023 a 100% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(38, 3, 8, 'Incrementar el número de personas beneficiadas a través del Servicio Cívico Militar Voluntario de 9.657 en el año 2022 a 36.853 al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(39, 3, 9, 'Incrementar el porcentaje de Personas Privadas de Libertad (PPL) participantes en al menos un eje de tratamiento de 41,67% en el año 2023 a 44,17% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(40, 3, 10, 'Reducir la tasa de hacinamiento en los Centros de Privación de Libertad de 13,45% en el año 2023 a 5,59% al 2025.', '2026-08-25 07:25:30', '2026-08-25 07:25:30'),
	(41, 3, 11, 'Incrementar la tasa de defensores públicos por cada 100.000 habitantes de 3,98 en el año 2023 a 4,08 al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(42, 3, 12, 'Mantener la tasa de pendencia de 1,13 al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(43, 3, 13, 'Mantener la tasa de resolución de 0,87 al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(44, 3, 14, 'Mantener la tasa de congestión de 2,13 al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(45, 3, 15, 'Incrementar el índice de identificación del riesgo cantonal de 41,98 en el año 2022 a 59,22 al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(46, 3, 16, 'Incrementar el índice de preparación para casos de desastres cantonal de 32,74% en el año 2022 a 39,80% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(47, 4, 1, 'Incrementar la participación de exportaciones no tradicionales en las exportaciones no petroleras de 42,73% en el año 2022 a 46,90% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(48, 4, 2, 'Incrementar las exportaciones de alta, media, baja intensidad tecnológica per cápita de 54,78 en el año 2023 a 55,09 al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(49, 4, 3, 'Incrementar la Inversión Privada de USD 2.317,88 millones en el año 2022 a USD 2.423,89 millones al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(50, 4, 4, 'Incrementar el monto de colocación de crédito de las entidades financieras públicas de USD 6.205,62 millones en el año 2022 a USD 7.375,10 millones al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(51, 4, 5, 'Incrementar la inversión extranjera directa de USD 845,05 millones en el año 2022 a USD 846,10 millones al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(52, 4, 6, 'Incrementar la calificación del Ecuador en el índice regional infrascopio de 48,66% en el año 2022 a 51,70% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(53, 4, 7, 'Incrementar la proporción del Presupuesto General del Estado financiado por ingresos tributarios internos de 32,37% en el año 2022 a 34,16% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(54, 4, 8, 'Mantener el porcentaje promedio anual de cobertura de los pasivos del primer sistema de balance BCE con las Reservas Internacionales (RI) de 100% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(55, 4, 9, 'Mantener la deuda pública y otras obligaciones de pago del Sector Público No Financiero (consolidada) como porcentaje del Producto Interno Bruto bajo el 57% al año 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(56, 4, 10, 'Incrementar el grado de implementación de planes de acción y políticas de compras públicas sostenibles de 14,00 puntos en el año 2023 a 26,00 puntos al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(57, 5, 1, 'Incrementar la tasa de variación de las exportaciones agropecuarias y agroindustriales de 1,54% en el año 2022 a 12,04% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(58, 5, 2, 'Incrementar el número de mujeres rurales de la AFC que se desempeñan como promotoras de sistemas de producción sustentable y sostenible de 1.652 en el 2023 a 2.852 al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(59, 5, 3, 'Incrementar el porcentaje de productores asociados, registrados como Agricultura Familiar Campesina que se vinculan a sistemas de comercialización de 33,7% en el año 2023 a 45,7% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(60, 5, 4, 'Incrementar el porcentaje de cobertura con riego tecnificado parcelario de pequeños y medianos productores de 18,19% en el año 2022 a 21,31% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(61, 5, 5, 'Incrementar el rendimiento de la productividad agrícola nacional de 129,97 en el año 2022 a 131,04 al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(62, 5, 6, 'Incrementar el VAB Pesca y Acuicultura sobre VAB ramas primarias de 16,86% en el año 2022 a 18,38% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(63, 5, 7, 'Incrementar el VAB manufacturero sobre VAB ramas primarias de 1,72 en el año 2022 a 1,73 al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(64, 5, 8, 'Incrementar el valor agregado bruto de la manufactura per cápita de USD 856,04 en el año 2022 a USD 954,72 al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(65, 5, 9, 'Incrementar el número de Escuelas de Fortalecimiento Productivo Pecuario establecidas de 97 en el año 2023 a 281 al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(66, 5, 10, 'Incrementar el ingreso de divisas por concepto de turismo receptor de USD 1.802,63 millones en el año 2022 a USD 2.434,00 millones al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(67, 5, 11, 'Incrementar el número de entradas de visitantes no residentes al Ecuador de 1,2 millones en el año 2022 a 2,0 millones al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(68, 5, 12, 'Incrementar la población con empleo en las principales actividades turísticas de 533.289 en el año 2022 a 550.000 al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(69, 6, 1, 'Aumentar la tasa de empleo adecuado (15 años y más) de 34,41% en el año 2022 a 39,09% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(70, 6, 2, 'Reducir la tasa de desempleo de 4,35% en el año 2022 a 3,73% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(71, 6, 3, 'Reducir la tasa de desempleo juvenil (18 a 29 años) de 9,29% en el año 2022 a 8,00% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(72, 6, 4, 'Reducir el trabajo infantil (5 a 14 años) de 5,78% en el año 2022 a 4,90% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(73, 6, 5, 'Reducir la brecha de empleo adecuado entre hombres y mujeres (15 y más años de edad) de 32,53% en el año 2022 a 28,80% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(74, 6, 6, 'Reducir la brecha salarial entre hombres y mujeres de 19,23% en el año 2022 a 18,17% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(75, 7, 1, 'Incrementar la capacidad instalada de nueva generación eléctrica de 7.154,57 MW en el año 2022 a 8.584,38 MW al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(76, 7, 2, 'Reducir las pérdidas de energía eléctrica en los sistemas de distribución de 13,25% en el año 2022 a 13,22% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(77, 7, 3, 'Incrementar la potencia instalada en subestaciones de distribución para atender el crecimiento de la demanda de energía eléctrica del país de 6.958,35 MVA en el año 2023 a 7.098,21 MVA al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(78, 7, 4, 'Incrementar el volumen de producción de hidrocarburos de 478.824,46 Barriles Equivalentes de Petróleo en el año 2023 a 550.033,60 Barriles Equivalentes de Petróleo al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(79, 7, 5, 'Incrementar las remediaciones de fuentes de contaminación de la industria hidrocarburífera ejecutadas por el Operador Estatal responsable y avaladas por la Autoridad Ambiental y del Recurso Hídrico Nacional de 1.846 en el año 2023 a 2.105 en el año 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(80, 7, 6, 'Incrementar el ahorro de combustibles en Barriles Equivalentes de Petróleo por la Optimización de Generación Eléctrica y Eficiencia Energética en el Sector de Hidrocarburos de 32,6 millones en el año 2023 a 41,5 millones al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(81, 7, 7, 'Incrementar la recaudación tributaria del sector minero de USD 202 millones en el año 2022 a USD 248 millones al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(82, 7, 8, 'Incrementar las exportaciones mineras de USD 2.775 millones en el año 2022 a USD 3.515 millones al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(83, 7, 9, 'Incrementar la superficie potencial de riego y drenaje con viabilidad técnica de 9.402,81 ha en el año 2023 a 13.402,81 ha al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(84, 7, 10, 'Incrementar el territorio nacional bajo garantías preventivas y mecanismos de protección del recurso hídrico de 264.039,89 ha en el año 2023 a 275.000,00 ha al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(85, 7, 11, 'Incrementar la población con acceso a agua apta para consumo humano de 3.017.778 en el año 2023 a 4.007.994 al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(86, 7, 12, 'Incrementar los residuos y/o desechos recuperados en el marco de la aplicación de la política de responsabilidad extendida del productor de 44,06% en el año 2022 a 56,06% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(87, 7, 13, 'Reducir la vulnerabilidad al cambio climático en función de la capacidad adaptativa de 82,98% en el año 2023 a 82,81% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(88, 7, 14, 'Mantener la proporción de territorio nacional bajo conservación o manejo ambiental de 22,16% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(89, 7, 15, 'Incrementar el índice de Inversión en la Reducción de Riesgo cantonal de 42,47 en el año 2022 a 51,77 al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(90, 8, 1, 'Incrementar el porcentaje de cobertura poblacional con tecnología 4G de 78,08% en el año 2022 a 80,00% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(91, 8, 2, 'Incrementar el porcentaje de parroquias rurales y cabeceras cantonales con presencia del servicio de internet fijo a través de enlaces de fibra óptica de 75,82% en el año 2022 a 86,79% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(92, 8, 3, 'Reducir la tasa de mortalidad por accidentes de tránsito in situ, de 13,37 en el 2023 a 12,66 para el 2025 por cada 100.000 habitantes.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(93, 8, 4, 'Mantener la tasa de accidentes en la operación de transporte aéreo comercial de cero accidentes al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(94, 8, 5, 'Incrementar el mantenimiento de la Red Vial estatal con modelo de gestión sostenible de 24,60% en el 2023 a 26,90% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(95, 8, 6, 'Incrementar el porcentaje de kilómetros en Buen Estado de la Red Vial Estatal de 42,29% en el año 2023 a 44,30% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(96, 9, 1, 'Aumentar el índice de percepción de la calidad de los servicios públicos en general de 6,05 en el año 2022 a 6,20 al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(97, 9, 2, 'Aumentar el índice de Implementación de la Mejora Regulatoria en el Estado para optimizar la calidad de vida de los ciudadanos, el clima de negocios y la competitividad de 39,60% en el año 2023 a 41,60% al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(98, 9, 3, 'Reducir el posicionamiento en el ranking de percepción de corrupción mundial del puesto 115 en el año 2023 a 109 al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(99, 9, 4, 'Incrementar el monto desembolsado de Cooperación Internacional No Reembolsable - CINR oficial y no gubernamental de USD 261,71 millones en el año 2022 a USD 327,14 millones al 2025.', '2026-08-25 07:25:31', '2026-08-25 07:25:31'),
	(100, 9, 5, 'Incrementar el porcentaje de Consejos Ciudadanos Sectoriales conformados de 27,59% en el año 2023 a 72,41% al 2025.', '2026-08-25 07:25:32', '2026-08-25 07:25:32'),
	(101, 9, 6, 'Incrementar el número de procesos de formación, capacitación, promoción y apoyo técnico a los espacios, mecanismos e instancias de Participación Ciudadana de 1.020 en el año 2023 a 2.111 al 2025.', '2026-08-25 07:25:32', '2026-08-25 07:25:32'),
	(102, 9, 7, 'Incrementar el porcentaje de entidades públicas que implementan el modelo de Gobierno Abierto de 40,00% en el año 2023 a 52,27% al 2025.', '2026-08-25 07:25:32', '2026-08-25 07:25:32'),
	(103, 9, 8, 'Incrementar el porcentaje de instituciones que llevan a cabo el proceso de rendición de cuentas de 81,37% en el año 2022 a 82,12% al 2025.', '2026-08-25 07:25:32', '2026-08-25 07:25:32'),
	(104, 9, 9, 'Incrementar el porcentaje de autoridades de elección popular que llevan a cabo el proceso de rendición de cuentas de 63,20% en el 2022 a 63,95% al 2025.', '2026-08-25 07:25:32', '2026-08-25 07:25:32'),
	(105, 9, 10, 'Mantener el índice de capacidad operativa promedio de los Gobiernos Autónomos Descentralizados municipales – ICO al menos en 17,28 puntos al 2025.', '2026-08-25 07:25:32', '2026-08-25 07:25:32'),
	(106, 10, 1, 'Incrementar el índice de fortalecimiento de la gobernanza local y multinivel de los Gobiernos Autónomos Descentralizados cantonales de 41,44 en el año 2022 a 56,26 al 2025.', '2026-08-25 07:25:32', '2026-08-25 07:25:32'),
	(107, 10, 2, 'Mantener la capacidad de protección financiera para la reducción de riesgos de los Gobiernos Autónomos Descentralizados cantonales de 27,73 al 2025.', '2026-08-25 07:25:32', '2026-08-25 07:25:32');

-- Volcando estructura para tabla sipeip.pnd_objetivos
DROP TABLE IF EXISTS `pnd_objetivos`;
CREATE TABLE IF NOT EXISTS `pnd_objetivos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pnd_eje_id` bigint unsigned NOT NULL,
  `numero` tinyint unsigned NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pnd_objetivos_eje_numero_unique` (`pnd_eje_id`,`numero`),
  CONSTRAINT `pnd_objetivos_pnd_eje_id_foreign` FOREIGN KEY (`pnd_eje_id`) REFERENCES `pnd_ejes` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.pnd_objetivos: ~10 rows (aproximadamente)
INSERT INTO `pnd_objetivos` (`id`, `pnd_eje_id`, `numero`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Mejorar las condiciones de vida de la población de forma integral, promoviendo el acceso equitativo a salud, vivienda y bienestar social', NULL, '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(2, 1, 2, 'Impulsar las capacidades de la ciudadanía con educación equitativa e inclusiva de calidad y promoviendo espacios de intercambio cultural', NULL, '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(3, 1, 3, 'Garantizar la seguridad integral, la paz ciudadana y transformar el sistema de justicia respetando los derechos humanos', NULL, '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(4, 2, 4, 'Estimular el sistema económico y de finanzas públicas para dinamizar la inversión y las relaciones comerciales', NULL, '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(5, 2, 5, 'Fomentar de manera sustentable la producción mejorando los niveles de productividad', NULL, '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(6, 2, 6, 'Incentivar la generación de empleo digno', NULL, '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(7, 3, 7, 'Precautelar el uso responsable de los recursos naturales con un entorno ambientalmente sostenible', NULL, '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(8, 3, 8, 'Impulsar la conectividad como fuente de desarrollo y crecimiento económico y sostenible', NULL, '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(9, 4, 9, 'Propender la construcción de un Estado eficiente, transparente y orientado al bienestar social', NULL, '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(10, 5, 10, 'Promover la resiliencia de ciudades y comunidades para enfrentar los riesgos de origen natural y antrópico', NULL, '2026-08-25 07:25:26', '2026-08-25 07:25:26');

-- Volcando estructura para tabla sipeip.pnd_politicas
DROP TABLE IF EXISTS `pnd_politicas`;
CREATE TABLE IF NOT EXISTS `pnd_politicas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pnd_objetivo_id` bigint unsigned NOT NULL,
  `codigo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pnd_politicas_codigo_unique` (`codigo`),
  KEY `pnd_politicas_pnd_objetivo_id_foreign` (`pnd_objetivo_id`),
  CONSTRAINT `pnd_politicas_pnd_objetivo_id_foreign` FOREIGN KEY (`pnd_objetivo_id`) REFERENCES `pnd_objetivos` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.pnd_politicas: ~72 rows (aproximadamente)
INSERT INTO `pnd_politicas` (`id`, `pnd_objetivo_id`, `codigo`, `nombre`, `created_at`, `updated_at`) VALUES
	(1, 1, '1.1', 'Contribuir a la reducción de la pobreza y pobreza extrema', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(2, 1, '1.2', 'Garantizar la inclusión social de las personas y grupos de atención prioritaria durante su ciclo de vida', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(3, 1, '1.3', 'Mejorar la prestación de los servicios de salud de manera integral, mediante la promoción, prevención, atención primaria, tratamiento, rehabilitación y cuidados paliativos, con talento humano suficiente y fortalecido, enfatizando la atención a grupos prioritarios y todos aquellos en situación de vulnerabilidad', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(4, 1, '1.4', 'Fortalecer la vigilancia, prevención y control de enfermedades transmisibles y no transmisibles', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(5, 1, '1.5', 'Garantizar el acceso a la información, educación integral de la sexualidad y servicios de salud sexual y reproductiva de calidad, para el pleno ejercicio de los derechos sexuales y reproductivos de la población', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(6, 1, '1.6', 'Promover el buen uso del tiempo libre en la población ecuatoriana a través de la práctica de actividad física', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(7, 1, '1.7', 'Implementar programas de prevención y promoción que aborden los determinantes de la salud alrededor de los diferentes problemas de malnutrición en toda la población, con énfasis en desnutrición crónica infantil', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(8, 1, '1.8', 'Garantizar el derecho a una vivienda adecuada y promover entornos habitables, seguros y saludables mediante acciones integrales, coordinadas y participativas, que contribuyan al fomento y desarrollo de ciudades y comunidades inclusivas, seguras, resilientes y sostenibles', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(9, 1, '1.9', 'Promover la inclusión social, el ejercicio de derechos y la no discriminación de los Pueblos y Nacionalidades', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(10, 1, '1.10', 'Fortalecer la bioeconomía de los Pueblos y Nacionalidades', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(11, 2, '2.1', 'Garantizar el acceso universal a una educación, inclusiva, equitativa, pertinente e intercultural para niños, niñas, adolescentes, jóvenes y adultos, promoviendo la permanencia y culminación de sus estudios; y asegurando su movilidad dentro del Sistema Nacional de Educación', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(12, 2, '2.2', 'Promover una educación de calidad con un enfoque innovador, competencial, inclusivo, resiliente y participativo, que fortalezca las habilidades cognitivas, socioemocionales, comunicacionales, digitales y para la vida práctica; sin discriminación y libre de todo tipo de violencia, apoyados con procesos de evaluación integral para la mejora continua', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(13, 2, '2.3', 'Fortalecer el sistema de educación superior a través del mejoramiento del acceso, permanencia y titularización con criterios de democracia, calidad y meritocracia', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(14, 2, '2.4', 'Desarrollar el sistema de educación superior a través de nuevas modalidades de estudio, carreras y profundización de la educación técnica tecnológica como mecanismo para la profesionalización de la población', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(15, 2, '2.5', 'Fomentar la investigación, desarrollo e innovación (I+D+i) con el acceso a fondos concursables de investigación científica, la creación de comunidades científicas de apoyo y la inclusión de actores de los saberes ancestrales', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(16, 2, '2.6', 'Promover la conservación, salvaguardia y desarrollo del patrimonio material e inmaterial', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(17, 2, '2.7', 'Impulsar la creación artística y las industrias culturales', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(18, 2, '2.8', 'Garantizar la preparación integral de los atletas de alto rendimiento y reserva deportiva, para alcanzar logros deportivos', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(19, 3, '3.1', 'Prever, prevenir y controlar, con pertinencia territorial, los fenómenos de violencia y delincuencia que afectan a la ciudadanía y sus derechos, fortaleciendo la convivencia pacífica', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(20, 3, '3.2', 'Contrarrestar las economías criminales, fortaleciendo las acciones de investigación, persecución y control de la delincuencia organizada, el narcotráfico, la minería ilegal, el control migratorio, apoyando a la consolidación y sostenibilidad del sistema económico', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(21, 3, '3.3', 'Fortalecer a las instituciones y entidades de la defensa para garantizar la soberanía, integridad territorial y contribuir a la paz y seguridad internacional', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(22, 3, '3.4', 'Fortalecer la acción interinstitucional y el relacionamiento con la sociedad para contribuir a la seguridad integral y al desarrollo nacional', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(23, 3, '3.5', 'Fortalecer el ejercicio de los derechos de las personas que se encuentran en situación de movilidad humana', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(24, 3, '3.6', 'Generar inteligencia y actividades de contrainteligencia que permitan proteger a los elementos estructurales del Estado', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(25, 3, '3.7', 'Fomentar una cultura de inteligencia a nivel nacional para mejorar el conocimiento y aporte de la sociedad a la seguridad integral del Estado', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(26, 3, '3.8', 'Fortalecer la seguridad de los Centros de Privación de la Libertad y Centros de Adolescentes Infractores y la protección de las personas privadas de la libertad y adolescentes infractores a través de la prevención, control y mantenimiento del orden interno, en el marco del debido proceso y respeto a los derechos humanos', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(27, 3, '3.9', 'Fortalecer los procesos de rehabilitación social y reeducación de adolescentes infractores, garantizando los derechos de las personas privadas de libertad y de adolescentes infractores', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(28, 3, '3.10', 'Impulsar la reducción de riesgo de desastres y atención oportuna a emergencias ante amenazas naturales o antrópicas en todos los sectores y niveles territoriales', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(29, 3, '3.11', 'Fomentar la cultura de prevención de riesgos de desastres y la resiliencia comunitaria', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(30, 3, '3.12', 'Contribuir al fortalecimiento de la ciberseguridad en el sector de las telecomunicaciones', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(31, 3, '3.13', 'Incrementar la efectividad de los mecanismos de promoción y reparación de derechos humanos, mediante el cumplimiento de las obligaciones nacionales e internacionales en esta materia', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(32, 3, '3.14', 'Reducir la discriminación y violencia basada en género mediante la prevención, atención y protección integral a la población ecuatoriana y extranjera residente dentro del territorio ecuatoriano, especialmente a la población vulnerable integrada por mujeres, niños, niñas, adolescentes, y personas LGBTIQ+', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(33, 3, '3.15', 'Institucionalizar la transparencia e integridad en la Función Judicial, facilitar el control social y asegurar el óptimo acceso a los servicios de justicia', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(34, 3, '3.16', 'Garantizar la prestación gratuita de los servicios defensoriales para el ejercicio de los derechos de la ciudadanía', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(35, 4, '4.1', 'Profundizar la inserción estratégica de Ecuador en la comunidad internacional para contribuir al crecimiento y desarrollo económico', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(36, 4, '4.2', 'Incrementar la apertura comercial con socios estratégicos y con países que constituyan mercados potenciales', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(37, 4, '4.3', 'Generar un clima adecuado de negocios para la atracción y mantenimiento de inversiones', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(38, 4, '4.4', 'Incrementar el uso de procesos competitivos de contratación pública de régimen común', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(39, 4, '4.5', 'Incluir progresivamente criterios de sostenibilidad en los procesos de compras públicas en Ecuador', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(40, 4, '4.6', 'Fortalecer un sistema tributario de forma progresiva, equitativa y eficiente', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(41, 4, '4.7', 'Fortalecer un sistema de finanzas públicas eficiente y sostenible', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(42, 4, '4.8', 'Fortalecer la dolarización, consolidar el acceso a financiamiento y promover la regulación financiera', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(43, 4, '4.9', 'Establecer el entorno normativo e institucional para atraer, facilitar, estructurar, concretar y proteger las inversiones en Asociaciones Público-Privadas', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(44, 5, '5.1', 'Incrementar la oferta del sector agropecuario para satisfacer la demanda nacional e internacional de productos tradicionales y no tradicionales de calidad', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(45, 5, '5.2', 'Fortalecer los sistemas agroalimentarios y prácticas innovadoras que propendan a la sostenibilidad ambiental', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(46, 5, '5.3', 'Incrementar la productividad, desarrollo y la diversificación de la producción acuícola y pesquera, incentivando el uso de tecnologías modernas y limpias', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(47, 5, '5.4', 'Posicionar al destino Ecuador en el mercado nacional e internacional en función del desarrollo equilibrado de la oferta turística, generación de alianzas estratégicas y la gestión integral del territorio', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(48, 5, '5.5', 'Fomentar la productividad, competitividad, comercialización, industrialización y generación de valor agregado en el sector agroindustrial, industrial y manufacturero a nivel nacional', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(49, 6, '6.1', 'Fomentar las oportunidades de empleo digno de manera inclusiva garantizando el cumplimiento de derechos laborales', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(50, 6, '6.2', 'Incentivar el desarrollo sostenible de las unidades productivas (MIPYMES)', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(51, 6, '6.3', 'Impulsar la generación de empleo a través de mecanismos de crecimiento y expansión de empresas con pertinencia territorial', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(52, 6, '6.4', 'Desarrollar las capacidades de los jóvenes de 18 a 29 años para promover su inserción laboral', '2026-08-25 07:25:26', '2026-08-25 07:25:26'),
	(53, 6, '6.5', 'Garantizar la igualdad de remuneración y/o retribución económica entre hombres y mujeres por un trabajo de igual valor', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(54, 7, '7.1', 'Garantizar la sostenibilidad en el continuo abastecimiento de energía eléctrica en el Ecuador, con el aprovechamiento óptimo de los recursos naturales con los que cuenta el país; y, propender el uso racional y eficiente de la energía eléctrica por parte de los consumidores', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(55, 7, '7.2', 'Garantizar el manejo eficiente de los recursos naturales no renovables, a través del uso de tecnologías sostenibles, que permitan optimizar la producción nacional de hidrocarburos, y demás actividades de la cadena de valor del sector, con responsabilidad social y ambiental', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(56, 7, '7.3', 'Fortalecer el desarrollo responsable del sector minero a través de estrategias integrales que involucren la sostenibilidad ambiental y social e impulsen el crecimiento económico del país', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(57, 7, '7.4', 'Conservar y restaurar los recursos naturales renovables terrestres y marinos, fomentando modelos de desarrollo sostenibles, bajos en emisiones y resilientes a los efectos adversos del cambio climático', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(58, 7, '7.5', 'Promover la articulación de la gestión ambiental, del cambio climático y la reducción del riesgo de desastres', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(59, 7, '7.6', 'Fortalecer la resiliencia de las infraestructuras para garantizar la seguridad de los usuarios ante riesgos y peligros', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(60, 7, '7.7', 'Promover la gestión integral e integrada del recurso hídrico y su conservación, fomentando el derecho humano al agua potable en cantidad y calidad, y su saneamiento; así como, el riego y drenaje en un entorno adaptativo a los efectos del cambio climático', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(61, 8, '8.1', 'Mejorar la conectividad digital y el acceso a nuevas tecnologías para la población', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(62, 8, '8.2', 'Optimizar las infraestructuras construidas, capacidades instaladas y de gestión del transporte multimodal, para una movilización nacional e internacional de personas, bienes y mercancías de manera sostenible, oportuna y segura', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(63, 9, '9.1', 'Fomentar la participación ciudadana con enfoques de igualdad, en todos los niveles de gobierno y funciones del Estado, que permita realizar el monitoreo y evaluación de la gestión pública, fortaleciendo la rendición de cuentas', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(64, 9, '9.2', 'Impulsar el Gobierno Abierto que propicie la transparencia y el acceso de información oportuna y cercana a la ciudadanía', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(65, 9, '9.3', 'Fomentar buenas prácticas regulatorias y la simplificación normativa y administrativa que promueva la innovación de la gestión pública', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(66, 9, '9.4', 'Diseñar mecanismos interinstitucionales de identificación, prevención y gestión de conflictos para su implementación en la Función Ejecutiva', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(67, 9, '9.5', 'Consolidar los Consejos Ciudadanos Sectoriales de la Función Ejecutiva, involucrando a las organizaciones sociales, en los procesos de diálogo, deliberación, seguimiento y evaluación de las políticas públicas de carácter ministerial y sectorial, a fin de garantizar la gobernabilidad', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(68, 9, '9.6', 'Fortalecer las capacidades del Estado que garanticen la transparencia, eficiencia, calidad y excelencia de los servicios públicos', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(69, 9, '9.7', 'Ampliar y fortalecer la cooperación internacional para el desarrollo sostenible del Ecuador en función de las prioridades determinadas por el Gobierno Nacional', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(70, 9, '9.8', 'Fomentar la integridad pública y la lucha contra la corrupción en coordinación interinstitucional efectiva entre todas las funciones del Estado', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(71, 10, '10.1', 'Fortalecer el Sistema Nacional Descentralizado de Gestión de Riesgos de Desastres mediante una gestión efectiva y oportuna con visión prospectiva', '2026-08-25 07:25:27', '2026-08-25 07:25:27'),
	(72, 10, '10.2', 'Implementar medidas de comprensión, prevención, mitigación y participación ciudadana para la gestión de riesgos de desastres', '2026-08-25 07:25:27', '2026-08-25 07:25:27');

-- Volcando estructura para tabla sipeip.programas
DROP TABLE IF EXISTS `programas`;
CREATE TABLE IF NOT EXISTS `programas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `entidad_id` bigint unsigned NOT NULL,
  `codigo` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `periodo_inicio` year NOT NULL,
  `periodo_fin` year NOT NULL,
  `responsable_id` bigint unsigned NOT NULL,
  `estado` enum('Activo','Inactivo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activo',
  `estado_proceso` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Borrador',
  `usuario_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `programas_entidad_codigo_unique` (`entidad_id`,`codigo`),
  KEY `programas_responsable_id_foreign` (`responsable_id`),
  KEY `programas_usuario_id_foreign` (`usuario_id`),
  CONSTRAINT `programas_entidad_id_foreign` FOREIGN KEY (`entidad_id`) REFERENCES `entidades` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `programas_responsable_id_foreign` FOREIGN KEY (`responsable_id`) REFERENCES `users` (`id`),
  CONSTRAINT `programas_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.programas: ~1 rows (aproximadamente)
INSERT INTO `programas` (`id`, `entidad_id`, `codigo`, `nombre`, `descripcion`, `periodo_inicio`, `periodo_fin`, `responsable_id`, `estado`, `estado_proceso`, `usuario_id`, `created_at`, `updated_at`) VALUES
	(1, 2, 'PROG-001', 'Programa de Fortalecimiento de los Servicios Públicos Institucionales', 'Programa orientado a fortalecer la capacidad institucional y mejorar la prestación de servicios públicos mediante proyectos de inversión alineados con los Objetivos Estratégicos Institucionales.', '2026', '2029', 6, 'Activo', 'En revisión', 7, '2026-09-19 08:27:47', '2026-09-19 08:33:46');

-- Volcando estructura para tabla sipeip.programa_objetivo
DROP TABLE IF EXISTS `programa_objetivo`;
CREATE TABLE IF NOT EXISTS `programa_objetivo` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `programa_id` bigint unsigned NOT NULL,
  `objetivo_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `programa_objetivo_unique` (`programa_id`,`objetivo_id`),
  KEY `programa_objetivo_objetivo_id_foreign` (`objetivo_id`),
  CONSTRAINT `programa_objetivo_objetivo_id_foreign` FOREIGN KEY (`objetivo_id`) REFERENCES `objetivos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `programa_objetivo_programa_id_foreign` FOREIGN KEY (`programa_id`) REFERENCES `programas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.programa_objetivo: ~4 rows (aproximadamente)
INSERT INTO `programa_objetivo` (`id`, `programa_id`, `objetivo_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2026-09-19 08:27:47', '2026-09-19 08:27:47'),
	(2, 1, 2, '2026-09-19 08:27:47', '2026-09-19 08:27:47'),
	(3, 1, 3, '2026-09-19 08:28:01', '2026-09-19 08:28:01'),
	(4, 1, 4, '2026-09-19 08:28:01', '2026-09-19 08:28:01');

-- Volcando estructura para tabla sipeip.proyectos
DROP TABLE IF EXISTS `proyectos`;
CREATE TABLE IF NOT EXISTS `proyectos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `programa_id` bigint unsigned NOT NULL,
  `entidad_id` bigint unsigned NOT NULL,
  `subsector_id` bigint unsigned NOT NULL,
  `codigo` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `presupuesto_aprobado` decimal(15,2) NOT NULL,
  `responsable_id` bigint unsigned NOT NULL,
  `estado` enum('Planificado','En ejecución','Finalizado','Suspendido') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Planificado',
  `estado_administrativo` enum('Activo','Inactivo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activo',
  `estado_proceso` enum('Borrador','En revisión','Observado','Priorizado','Negado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Borrador',
  `usuario_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `proyectos_entidad_codigo_unique` (`entidad_id`,`codigo`),
  KEY `proyectos_programa_id_foreign` (`programa_id`),
  KEY `proyectos_responsable_id_foreign` (`responsable_id`),
  KEY `proyectos_usuario_id_foreign` (`usuario_id`),
  KEY `proyectos_subsector_id_foreign` (`subsector_id`),
  CONSTRAINT `proyectos_entidad_id_foreign` FOREIGN KEY (`entidad_id`) REFERENCES `entidades` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `proyectos_programa_id_foreign` FOREIGN KEY (`programa_id`) REFERENCES `programas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `proyectos_responsable_id_foreign` FOREIGN KEY (`responsable_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `proyectos_subsector_id_foreign` FOREIGN KEY (`subsector_id`) REFERENCES `subsectores` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `proyectos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.proyectos: ~1 rows (aproximadamente)
INSERT INTO `proyectos` (`id`, `programa_id`, `entidad_id`, `subsector_id`, `codigo`, `nombre`, `descripcion`, `fecha_inicio`, `fecha_fin`, `presupuesto_aprobado`, `responsable_id`, `estado`, `estado_administrativo`, `estado_proceso`, `usuario_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, 2, 'PRY-001', 'Fortalecimiento de la atención primaria en salud', 'Implementación y mejoramiento de infraestructura, equipamiento y servicios para fortalecer la atención primaria en salud de la población.', '2027-01-01', '2028-12-31', 250000.00, 7, 'Planificado', 'Activo', 'Priorizado', 6, '2026-09-19 09:43:03', '2026-09-19 09:43:35');

-- Volcando estructura para tabla sipeip.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activo',
  `asignable_institucion` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_nombre_unique` (`nombre`),
  UNIQUE KEY `roles_codigo_unique` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.roles: ~9 rows (aproximadamente)
INSERT INTO `roles` (`id`, `nombre`, `codigo`, `descripcion`, `estado`, `asignable_institucion`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador Global', 'ADMIN_GLOBAL', 'Administra la configuración global de la plataforma, incluyendo roles, entidades, usuarios y catálogos generales del sistema.', 'Activo', 0, '2026-08-25 07:25:22', '2026-08-25 07:46:16'),
	(2, 'Administrador del Sistema', 'ADMIN_SISTEMA', 'Administra la configuración y operación del sistema de acuerdo con los permisos asignados.', 'Activo', 0, '2026-08-25 07:25:22', '2026-08-25 07:46:16'),
	(3, 'Administrador Institucional', 'ADMIN_INSTITUCIONAL', 'Administra la configuración institucional, usuarios y parámetros propios de la entidad.', 'Activo', 1, '2026-08-25 07:25:22', '2026-08-25 07:46:16'),
	(4, 'Director de Planificación', 'DIRECTOR_PLANIFICACION', 'Supervisa y aprueba la planificación institucional, incluyendo planes, objetivos, metas e indicadores.', 'Activo', 1, '2026-08-25 07:25:22', '2026-08-25 07:46:16'),
	(5, 'Analista de Planificación', 'ANALISTA_PLANIFICACION', 'Registra y actualiza planes, objetivos, metas e indicadores institucionales.', 'Activo', 1, '2026-08-25 07:25:22', '2026-08-26 05:47:21'),
	(6, 'Director de Inversión Pública', 'DIRECTOR_INVERSION', 'Supervisa programas, proyectos y el seguimiento de la inversión pública institucional.', 'Activo', 1, '2026-08-25 07:25:22', '2026-08-25 07:46:16'),
	(7, 'Analista de Inversión Pública', 'ANALISTA_INVERSION', 'Registra y administra programas, proyectos y seguimiento de la inversión pública.', 'Activo', 1, '2026-08-25 07:25:22', '2026-08-25 07:46:16'),
	(8, 'Auditor Institucional', 'AUDITOR_INSTITUCIONAL', 'Consulta la auditoría, historial de cambios y reportes para fines de control y seguimiento institucional.', 'Activo', 1, '2026-08-25 07:25:22', '2026-09-17 03:19:45'),
	(9, 'Consulta Institucional', 'CONSULTA_INSTITUCIONAL', 'Accede únicamente en modo consulta a la información autorizada de su institución.', 'Activo', 1, '2026-08-25 07:25:22', '2026-08-25 07:46:16');

-- Volcando estructura para tabla sipeip.sectores
DROP TABLE IF EXISTS `sectores`;
CREATE TABLE IF NOT EXISTS `sectores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `macrosector_id` bigint unsigned NOT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sectores_macrosector_id_nombre_unique` (`macrosector_id`,`nombre`),
  KEY `sectores_estado_index` (`estado`),
  CONSTRAINT `sectores_macrosector_id_foreign` FOREIGN KEY (`macrosector_id`) REFERENCES `macrosectores` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.sectores: ~24 rows (aproximadamente)
INSERT INTO `sectores` (`id`, `macrosector_id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Salud', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(2, 1, 'Cultura', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(3, 1, 'Equipamiento Urbano y Vivienda', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(4, 1, 'Protección Social y Familiar', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(5, 1, 'Deporte', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(6, 2, 'Energía', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(7, 2, 'Minería e Hidrocarburos', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(8, 2, 'Ambiente', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(9, 2, 'Telecomunicaciones', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(10, 3, 'Agricultura, Ganadería y Pesca', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(11, 3, 'Fomento a la Producción', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(12, 3, 'Vialidad y Transporte', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(13, 4, 'Planificación y Regulación', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(14, 4, 'Manejo Fiscal', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(15, 4, 'Legislativo', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(16, 4, 'Información', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(17, 4, 'Asuntos del Exterior', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(18, 5, 'Seguridad', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(19, 5, 'Justicia', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(20, 5, 'Defensa', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(21, 6, 'Educación', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(22, 6, 'Proyectos de Investigación y Becas', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(23, 8, 'Sector 1 edit', 'Activo', '2026-09-19 06:59:53', '2026-09-19 07:06:56'),
	(24, 8, 'Sector 2', 'Activo', '2026-09-19 07:01:11', '2026-09-19 07:01:11');

-- Volcando estructura para tabla sipeip.sessions
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.sessions: ~1 rows (aproximadamente)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('i27V0RZHdtghqkolsC1iR2eDLON7zrVcVqt1BS9H', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ0MGViN3RNSGNEUjFNUHBGejFHRWZ5Tk1UZXRoZW5nZHZkT3Z0UXFuIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvc2lwZWlwLnRlc3RcL3BsYW5lc1wvbGlzdGFyIiwicm91dGUiOiJwbGFuZXMubGlzdGFyIn0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjo1fQ==', 1790012506),
	('kjVyVm9uDLkgKUydTjxumSEqIj86HkqEoAgUjpOk', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJBQXd6d2p1YnZmdjI4SXp4SkpPd0R1UjRYbFN1NmVRSXJRUjhMQjhTIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvc2lwZWlwLnRlc3RcL2Rhc2hib2FyZCIsInJvdXRlIjoiZGFzaGJvYXJkIn0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjo3fQ==', 1790012088);

-- Volcando estructura para tabla sipeip.subsectores
DROP TABLE IF EXISTS `subsectores`;
CREATE TABLE IF NOT EXISTS `subsectores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sector_id` bigint unsigned NOT NULL,
  `codigo` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nivel_gobierno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Nacional',
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subsectores_sector_id_nombre_unique` (`sector_id`,`nombre`),
  UNIQUE KEY `subsectores_codigo_unique` (`codigo`),
  KEY `subsectores_estado_index` (`estado`),
  CONSTRAINT `subsectores_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `sectores` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.subsectores: ~104 rows (aproximadamente)
INSERT INTO `subsectores` (`id`, `sector_id`, `codigo`, `nombre`, `nivel_gobierno`, `estado`, `created_at`, `updated_at`) VALUES
	(1, 1, 'A0101', 'Administración Salud', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(2, 1, 'A0102', 'Primer Nivel de Atención', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(3, 1, 'A0103', 'Segundo Nivel de Atención', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(4, 1, 'A0104', 'Tercer Nivel de Atención', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(5, 1, 'A0105', 'Productos Farmacéuticos y Químicos', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(6, 1, 'A0121', 'Intersubsectorial Salud', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(7, 2, 'A0301', 'Administración Arte y Cultura', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(8, 2, 'A0302', 'Arte y Cultura', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(9, 2, 'A0321', 'Intersubsectorial Cultura', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(10, 3, 'A0601', 'Administración Equipamiento Urbano y Vivienda', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(11, 3, 'A0602', 'Agua Potable', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(12, 3, 'A0603', 'Alcantarillado', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(13, 3, 'A0604', 'Vivienda', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(14, 3, 'A0605', 'Reasentamientos Humanos', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(15, 3, 'A0606', 'Desechos Sólidos', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(16, 3, 'A0607', 'Otro Equipamiento Urbano', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(17, 3, 'A0621', 'Intersubsectorial Equipamiento Urbano y Vivienda', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(18, 4, 'A0701', 'Administración Protección Social y Familiar', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(19, 4, 'A0702', 'Atención a Víctimas', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(20, 4, 'A0703', 'Atención Primera Infancia', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(21, 4, 'A0704', 'Atención Adolescentes Jóvenes', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(22, 4, 'A0705', 'Atención Adultos Mayores', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(23, 4, 'A0706', 'Atención Discapacitados', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(24, 4, 'A0707', 'Equidad de Género', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(25, 4, 'A0708', 'Inclusión Social', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(26, 4, 'A0709', 'Desarrollo Rural', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(27, 4, 'A0721', 'Intersubsectorial Protección Social y Familiar', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(28, 5, 'A0901', 'Administración Deporte', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(29, 5, 'A0902', 'Deporte Competitivo', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(30, 5, 'A0903', 'Deporte Formativo', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(31, 5, 'A0904', 'Deporte Recreativo', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(32, 5, 'A0921', 'Intersubsectorial Deporte', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(33, 6, 'B1001', 'Administración Energía', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(34, 6, 'B1002', 'Alumbrado Público', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(35, 6, 'B1003', 'Distribución y Conexión Final Usuarios', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(36, 6, 'B1004', 'Generación', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(37, 6, 'B1005', 'Transmisión', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(38, 6, 'B1006', 'Energías Renovables', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(39, 6, 'B1021', 'Intersubsectorial Energía', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(40, 7, 'B1101', 'Administración Minería e Hidrocarburos', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(41, 7, 'B1102', 'Hidrocarburos', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(42, 7, 'B1103', 'Minería', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(43, 7, 'B1121', 'Intersubsectorial Minería e Hidrocarburos', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(44, 8, 'B0801', 'Administración Ambiente', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(45, 8, 'B0802', 'Conservación y Manejo Ambiental', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(46, 8, 'B0803', 'Prevención, Mitigación y Gestión del Riesgo', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(47, 8, 'B0804', 'Cadena Forestal Sustentable y sus Productos Elaborados', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(48, 8, 'B0821', 'Intersubsectorial Ambiente', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(49, 9, 'B1201', 'Administración Telecomunicaciones', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(50, 9, 'B1202', 'Comunicaciones', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(51, 9, 'B1221', 'Intersubsectorial Telecomunicaciones', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(52, 10, 'C1501', 'Administración Agricultura, Ganadería y Pesca', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(53, 10, 'C1502', 'Agricultura, Agroindustria y Alimentos', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(54, 10, 'C1503', 'Recuperación de Cultivos', 'Nacional', 'Activo', '2026-09-19 05:16:54', '2026-09-19 05:16:54'),
	(55, 10, 'C1504', 'Ganadería', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(56, 10, 'C1505', 'Pesca', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(57, 10, 'C1506', 'Riego', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(58, 10, 'C1521', 'Intersubsectorial Agricultura, Ganadería y Pesca', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(59, 11, 'C1601', 'Administración Fomento a la Producción', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(60, 11, 'C1602', 'Comercio', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(61, 11, 'C1603', 'Financiamiento', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(62, 11, 'C1604', 'Otras Industrias', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(63, 11, 'C1605', 'Turismo', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(64, 11, 'C1606', 'Confecciones y Calzado', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(65, 11, 'C1607', 'Metalmecánica y Vehículos', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(66, 11, 'C1608', 'Siderurgia', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(67, 12, 'C1301', 'Administración Vialidad y Transporte', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(68, 12, 'C1302', 'Terminales Marítimos y Puertos', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(69, 12, 'C1303', 'Terminales Terrestres', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(70, 12, 'C1304', 'Transporte Aéreo', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(71, 12, 'C1305', 'Transporte Terrestre', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(72, 12, 'C1306', 'Transporte Ferroviario', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(73, 12, 'C1307', 'Transporte Marítimo, Fluvial y Lacustre', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(74, 12, 'C1308', 'Vialidad Especial: Ciclovías, Senderos Peatonales, Pasos Peatonales, etc.', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(75, 12, 'C1321', 'Intersubsectorial Vialidad y Transporte', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(76, 13, 'D1801', 'Administración Planificación y Regulación', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(77, 14, 'D1901', 'Administración Fiscal', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(78, 15, 'D2001', 'Administración Legislativa', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(79, 16, 'D2201', 'Administración Información', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(80, 16, 'D2202', 'Generación de Información', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(81, 17, 'F2101', 'Administración Asuntos del Exterior', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(82, 18, 'F0401', 'Administración Seguridad', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(83, 18, 'F0402', 'Rehabilitación', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(84, 18, 'F0403', 'Seguridad', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(85, 18, 'F0421', 'Intersubsectorial Seguridad', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(86, 19, 'F0501', 'Administración Justicia', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(87, 19, 'F0502', 'Asistencia Judicial', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(88, 19, 'F0521', 'Intersubsectorial Justicia', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(89, 20, 'F1401', 'Administración Defensa', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(90, 20, 'F1402', 'Defensa', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(91, 20, 'F1421', 'Intersubsectorial Defensa', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(92, 21, 'E2301', 'Administración Educación', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(93, 21, 'E2302', 'Educación Prebásica', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(94, 21, 'E2303', 'Educación Básica y Media', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(95, 21, 'E2304', 'Educación Media Técnico', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(96, 21, 'E2305', 'Educación Superior', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(97, 21, 'E2306', 'Educación Diferencial y Especial', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(98, 21, 'E2307', 'Educación para Adultos', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(99, 21, 'E2321', 'Intersubsectorial Educación', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(100, 22, 'E1701', 'Administración Proyectos de Investigación y Becas', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(101, 22, 'E1702', 'Becas', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(102, 22, 'E1703', 'Proyecto Investigación', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(103, 22, 'E1704', 'Biotecnología', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(104, 22, 'E1705', 'Desarrollo de Tecnología (Hardware y Software)', 'Nacional', 'Activo', '2026-09-19 05:16:55', '2026-09-19 05:16:55'),
	(105, 23, 'A1005', 'sub sectro de prueba edit', 'Nacional', 'Activo', '2026-09-19 07:06:10', '2026-09-19 07:07:13');

-- Volcando estructura para tabla sipeip.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rol_id` bigint unsigned NOT NULL,
  `entidad_id` bigint unsigned DEFAULT NULL,
  `identificacion` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activo',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_identificacion_unique` (`identificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sipeip.users: ~14 rows (aproximadamente)
INSERT INTO `users` (`id`, `rol_id`, `entidad_id`, `identificacion`, `nombres`, `apellidos`, `cargo`, `estado`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '1710000001', 'Santiago', 'Moposa', 'Administrador Global', 'Activo', 'Santiago Moposa', 'santiago.moposa@planificacion.gob.ec', '2026-08-25 07:25:22', '$2y$12$UWoP0OjLMp7oJU2ocwLiEO6cME6tlmlYmspeZOrCRf5JlxUa62HuO', NULL, '2026-08-25 07:25:22', '2026-09-15 07:44:05'),
	(2, 2, 1, '1710000002', 'Laura', 'Mendoza', 'Administrador del Sistema', 'Activo', 'Laura Mendoza', 'laura.mendoza@planificacion.gob.ec', '2026-08-25 07:25:22', '$2y$12$kaRHRPFP0FT4HGgORuoTFedurnCoy6.6orQAFr9vlAUWJsGUuivY6', NULL, '2026-08-25 07:25:22', '2026-08-25 07:25:22'),
	(3, 3, 2, '1710000003', 'María', 'Fernández', 'Administradora Institucional', 'Activo', 'María Fernández', 'maria.fernandez@mtop.gob.ec', '2026-08-25 07:25:22', '$2y$12$td9NNresPWOzwSVeonXXL.w.12/iWJjxPm19WhillIAE3Vt/RpY9K', NULL, '2026-08-25 07:25:23', '2026-08-25 07:25:23'),
	(4, 4, 2, '1710000004', 'Jorge', 'Herrera', 'Director de Planificación', 'Activo', 'Jorge Herrera', 'jorge.herrera@mtop.gob.ec', '2026-08-25 07:25:23', '$2y$12$rYVLXhz3klF.1u62Gqnk9eGkYnZjNe/pLSJyT1BrS4Lkp4MF7cwQi', NULL, '2026-08-25 07:25:23', '2026-08-25 07:25:23'),
	(5, 5, 2, '1710000005', 'Andrea', 'Paredes', 'Analista de Planificación', 'Activo', 'Andrea Paredes', 'andrea.paredes@mtop.gob.ec', '2026-08-25 07:25:23', '$2y$12$hC4sOGpTPxyaSgGLw2NHGeRNTASIv3Kp3Yzgo4NmZueLxnL6X/CMq', NULL, '2026-08-25 07:25:23', '2026-08-25 07:25:23'),
	(6, 6, 2, '1710000006', 'Luis', 'Morales', 'Director de Inversión Pública', 'Activo', 'Luis Morales', 'luis.morales@mtop.gob.ec', '2026-08-25 07:25:23', '$2y$12$tD4gapVfCojCzfEEmCJTzOONtk2DGWD0XPIXyCOT1shcSNI39JrwW', NULL, '2026-08-25 07:25:23', '2026-08-25 07:25:23'),
	(7, 7, 2, '1710000007', 'Diana', 'Cevallos', 'Analista de Inversión Pública', 'Activo', 'Diana Cevallos', 'diana.cevallos@mtop.gob.ec', '2026-08-25 07:25:23', '$2y$12$632RhzU7gUxIy5Q79fvJuePSA3IOtkjeiecR0DQDqiY82I./tgobW', NULL, '2026-08-25 07:25:24', '2026-09-19 08:25:46'),
	(8, 8, 2, '1710000008', 'Pablo', 'Sánchez', 'Auditor Institucional', 'Activo', 'Pablo Sánchez', 'pablo.sanchez@mtop.gob.ec', '2026-08-25 07:25:24', '$2y$12$oLewcT4fd/JYmZbuvx9Dp.DqsFb4PC7eIBbCuFG9jhiwT2ZSeh0hG', NULL, '2026-08-25 07:25:24', '2026-08-25 07:25:24'),
	(9, 9, 2, '1710000009', 'Verónica', 'Castillo', 'Consulta Institucional', 'Activo', 'Verónica Castillo', 'veronica.castillo@mtop.gob.ec', '2026-08-25 07:25:24', '$2y$12$79lishgvxAFe/Fioz9nEoug8qzJbPwpqULmPIisSi6ba14SM9Ouku', NULL, '2026-08-25 07:25:24', '2026-08-25 07:25:24'),
	(10, 4, 3, '1710000010', 'Fernando', 'Torres', 'Director de Planificación', 'Activo', 'Fernando Torres', 'fernando.torres@salud.gob.ec', '2026-08-25 07:25:24', '$2y$12$TZnzPIYfdLwWuYrNOxYq3ulCbOYDX9u.W.Sb0j1DWWpEoVJ2xPAGa', NULL, '2026-08-25 07:25:24', '2026-08-25 07:25:24'),
	(11, 5, 3, '1710000011', 'Gabriela', 'Vega', 'Analista de Planificación', 'Activo', 'Gabriela Vega', 'gabriela.vega@salud.gob.ec', '2026-08-25 07:25:24', '$2y$12$MsWHiu.AknyU5JfSDsOfJ.tKCDu1ISG/075yT6tYM9WALv2bifWm6', NULL, '2026-08-25 07:25:25', '2026-08-25 07:25:25'),
	(12, 4, 4, '1710000012', 'Ricardo', 'Salazar', 'Director de Planificación', 'Activo', 'Ricardo Salazar', 'ricardo.salazar@educacion.gob.ec', '2026-08-25 07:25:25', '$2y$12$1vpi4DNPNcRu3DlZbkNde.NjQu11e6W47bEcWbRimQN27iuARf9nW', NULL, '2026-08-25 07:25:25', '2026-08-25 07:25:25'),
	(13, 5, 4, '1710000013', 'Daniela', 'Ruiz', 'Analista de Planificación', 'Activo', 'Daniela Ruiz', 'daniela.ruiz@educacion.gob.ec', '2026-08-25 07:25:25', '$2y$12$419t6VNWg8UXAP4toteSAe7fnefMX7JEA4wYnFIbgOyPx5TCD2GYe', NULL, '2026-08-25 07:25:25', '2026-08-25 07:25:25'),
	(14, 1, 1, '1714302856', 'Global', 'Global', 'Globa', 'Activo', 'Global Global', 'global@global.com', NULL, '$2y$12$2fw1S4eEG/NH1HWCWigGW.uofi.ba2F18fIrytXuKwNrS.jZ9sL2G', NULL, '2026-08-26 07:30:03', '2026-09-21 22:27:25');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
