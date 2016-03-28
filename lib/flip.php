<?php
namespace phatsk;
/**
 * PHP_TableFlip class
 * Namespace: phatsk
 * Author: github.com/phatsk
 * Version: 0.1.1
 * Description: Stupid little class to extend execption and error handling to include the
 * table flip emote. Makes errors more funner. By default, this class doesn't bind it's
 * handlers unless you pass true to the very first call of ::get_instance (or you manually
 * instantiate the class).
 */

if ( ! class_exists( 'phatsk\\PHP_TableFlip' ) ) {
	class PHP_TableFlip {
		/**
		 * Static instance of this class - we only really need one, right?
		 *
		 * @since 0.1
		 * @var phatsk\PHP_TableFlip
		 */
		protected static $instance;

		/**
		 * The flip emote.
		 *
		 * @since 0.1
		 * @var meme|string
		 */
		const FLIP = '(╯°□°）╯︵ ┻━┻';

		/**
		 * The fixing emote.
		 *
		 * @since 0.1.1
		 * @var meme|string
		 */
		const FIX = '┬─┬ノ(ಠ_ಠノ)';

		/**
		 * The emotional table flip, for when you mean business.
		 *
		 * @since 0.1.1
		 * @var meme|string
		 */
		const EMOTIONAL = '(ノಠ益ಠ)ノ彡┻━┻';

		/**
		 * Return the static instance if available, or create a new one.
		 *
		 * @since  0.1
		 * @param  bool $autobind True to have the class do the exception/error bindings.
		 *
		 * @return phatsk\PHP_TableFlip
		 */
		public static function get_instance( $autobind = false ) {
			if ( self::$instance ) {
				return self::$instance;
			}

			self::$instance = new self( $autobind );
			return self::$instance;
		}

		/**
		 * Create a new class.
		 *
		 * @since 0.1
		 * @param bool $autobind True to have the class do the exception/error bindings.
		 */
		public function __construct( $autobind = false ) {
			if ( $autobind ) {
				$this->attach_exceptions();
				$this->attach_error_handler();
			}
		}

		/**
		 * Simple helper for overriding the deafult exception handler.
		 *
		 * @since 0.1
		 *
		 * @return string|null The previous handler, if any, otherwise NULL.
		 */
		public function attach_exceptions() {
			return set_exception_handler( array( $this, 'flip_exception' ) );
		}

		/**
		 * Simple helper for overriding the default error handler.
		 *
		 * @since 0.1
		 *
		 * @return string|null The previous handler, if any, otherwise NULL.
		 */
		public function attach_error_handler() {
			set_error_handler( array( $this, 'flip_error' ) );
		}

		/**
		 * Prepend the exception with the table flip and throw it back.
		 *
		 * @since  0.1
		 * @param  Exception|Throwable $ex The exception or throwable.
		 * @throws Exception Every time.
		 */
		public function flip_exception( $ex ) {
			$message = self::FLIP . ' - ' . $ex->getMessage();
			throw new \Exception( $message, $ex->getCode(), $ex->getPrevious() );
		}

		/**
		 * Prepend the flip to the error message and stop execution if necessary.
		 *
		 * @param int    $errno  The PHP error number corresponding to an error constant.
		 * @param string $errstr The PHP error message.
		 */
		public function flip_error( $errno, $errstr ) {
			$error_type = 'E_NOTICE';
			$stop       = false;

			switch ( $errno ) {
				case E_ERROR:
					$error_type = 'E_ERROR';
					$stop       = true;
					break;
				case E_PARSE:
					$error_type = 'E_PARSE';
					break;
				case E_CORE_ERROR:
					$error_type = 'E_CORE_ERROR';
					$stop       = true;
					break;
				case E_CORE_WARNING:
					$error_type = 'E_CORE_WARNING';
					break;
				case E_COMPILE_ERROR:
					$error_type = 'E_COMPILE_ERROR';
					$stop       = true;
					break;
				case E_COMPILE_WARNING:
					$error_type = 'E_COMPILE_WARNING';
					break;
				case E_USER_ERROR:
					$error_type = 'E_USER_ERROR';
					$stop       = true;
					break;
				case E_USER_WARNING:
					$error_type = 'E_USER_WARNING';
					break;
				case E_USER_NOTICE:
					$error_type = 'E_USER_NOTICE';
					break;
				case E_STRICT:
					$error_type = 'E_STRICT';
					break;
			}

			echo "<b>" . self::FLIP . "</b> [{$error_type}] {$errstr}<br/>\n";

			if ( $stop ) {
		        echo "  Fatal error on line {$errline} in file {$errfile}";
				echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
				echo "Aborting...<br />\n";
				exit(1);
			}
		}

		/**
		 * Method for flipping when and how you like.
		 *
		 * @since 0.1.1
		 * @param string $type The type of flip, corresponds to the class constants. Or just use the constants, I don't
		 * care.
		 *
		 * @return meme|string
		 */
		public static function manual_flip( $type = 'flip' ) {
			$type = strtoupper( $type );

			if ( ! constant( "self::{$type}" ) ) {
				throw new \Exception( self::EMOTIONAL . ' - Incorrect flip flopped!' );
			}

			return constant( "self::{$type}" );
		}
	}
}

echo PHP_TableFlip::manual_flip('emotional_flip');
