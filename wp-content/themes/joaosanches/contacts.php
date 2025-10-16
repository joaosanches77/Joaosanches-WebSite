<?php
/**
 * Template Name: 002 - Contacts
 */

get_header();


$tagline = get_field('tagline');
$title = get_field('title');
$description = get_field('description');
$phone = get_field('phone');
$email = get_field('email');
?>

<main>
    <section class="bg-gradient-to-b from-beje-02 to-white padding-nav-small pb-24 sm:pb-40">
        <div class="main-container mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-5 ">

                <div class="flex flex-col wow animate__animated animate__fadeInLeft">
                    <div>
                        <p class="text-12px font-bold text-green-04 uppercase tracking-wider">
                            <?php echo esc_html($tagline); ?>
                        </p>
                        <h1 class="mt-4 text-48px 3xl:text-56px text-green-01">
                            <?php echo esc_html($title); ?>
                        </h1>
                        <p class="mt-4 text-16px text-grey-02 max-w-lg">
                            <?php echo esc_html($description); ?>
                        </p>
                    </div>
                    <div class="lg:mt-12 pt-8">
                        <p class="text-12px font-bold text-green-04 uppercase tracking-wider">
                            <?php _e("Informações de Contacto", "joaosanches"); ?>
                        </p>
                        <div class="mt-4 space-y-2">
                            <p>
                                <a href="tel:<?php echo esc_attr(str_replace(' ', '', $phone)); ?>"
                                    class="text-32px font-medium text-green-01 hover:text-green-03 lv-transition">
                                    <?php echo esc_html($phone); ?>
                                </a>
                            </p>
                            <p>
                                <a href="mailto:<?php echo esc_attr($email); ?>"
                                    class="text-32px font-medium text-green-01 hover:text-green-03 lv-transition">
                                    <?php echo esc_html($email); ?>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="wow animate__animated animate__fadeInRight">
                    <div class="space-y-4 sm:space-y-10">
                        <?= do_shortcode("[contact-form-7 id='c490d69']") ?>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?>



<!-- <form action="#" method="POST" class="space-y-4 sm:space-y-10">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="first-name" class="sr-only">Primeiro Nome</label>
                                <input type="text" name="first-name" id="first-name" placeholder="Primeiro Nome"
                                    class="w-full bg-transparent border border-grey-01 rounded-full px-6 py-4 text-green-01 placeholder:text-grey-02 focus:ring-green-04 focus:border-green-04 outline-none lv-transition">
                            </div>
                            <div>
                                <label for="last-name" class="sr-only">Último Nome</label>
                                <input type="text" name="last-name" id="last-name" placeholder="Último Nome"
                                    class="w-full bg-transparent border border-grey-01 rounded-full px-6 py-4 text-green-01 placeholder:text-grey-02 focus:ring-green-04 focus:border-green-04 outline-none lv-transition">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="phone" class="sr-only">Telefone</label>
                                <input type="tel" name="phone" id="phone" placeholder="Telefone"
                                    class="w-full bg-transparent border border-grey-01 rounded-full px-6 py-4 text-green-01 placeholder:text-grey-02 focus:ring-green-04 focus:border-green-04 outline-none lv-transition">
                            </div>
                            <div>
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" placeholder="Email" required
                                    class="w-full bg-transparent border border-grey-01 rounded-full px-6 py-4 text-green-01 placeholder:text-grey-02 focus:ring-green-04 focus:border-green-04 outline-none lv-transition">
                            </div>
                        </div>
                        <div
                            class="w-full bg-transparent border border-grey-01 rounded-full px-6 py-4 text-grey-02 focus:ring-green-04 focus:border-green-04">
                            <label for="department" class="sr-only">Departamento</label>
                            <select id="department" name="department"
                                class="w-full bg-transparent placeholder:text-grey-02 outline-none">
                                <option>Departamento</option>
                                <option>Comercial</option>
                                <option>Marketing</option>
                                <option>Recursos Humanos</option>
                            </select>
                        </div>
                        <div>
                            <label for="message" class="sr-only">Mensagem</label>
                            <textarea name="message" id="message" rows="3" placeholder="Mensagem"
                                class="w-full bg-transparent border border-grey-01 rounded-3xl px-6 py-4 text-green-01 placeholder:text-grey-02 focus:ring-green-04 focus:border-green-04 outline-none lv-transition"></textarea>
                        </div>
                        <div class="flex items-center">
                            <input id="terms" name="terms" type="checkbox"
                                class="h-4 w-4 rounded border-grey-01 text-green-04 focus:ring-green-04">
                            <label for="terms" class="ml-3 block text-sm text-grey-02">
                                Aceito todos os termos presentes na <a href="#"
                                    class="font-medium text-green-01 hover:underline">política de privacidade</a>.
                            </label>
                        </div>
                        <div>
                            <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-3 px-8 py-4 mt-4 border border-transparent rounded-full shadow-sm text-base font-medium text-green-01 bg-green-04/20 hover:bg-green-04/40 lv-transition">
                                Enviar
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path d="M11 13L20.5 3.5M3 9.92308L21 3L14.0769 21L10.6154 13.3846L3 9.92308Z"
                                        stroke="#001A17" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </form> -->