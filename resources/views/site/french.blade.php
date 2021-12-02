@extends('base.index')

@section('content')
    <!----french lead stories Section----->
    <section id="hero" class="d-flex align-items-center"  >
        <div class="container position-relative">
            <div class="row justify-content-center">
                {{--                <div class="icon-boxes">--}}
                <h3 class="text-center"><strong class="put-gold">Lead</strong> Stories</h3>

                @if($leading_articles)
                    <div class="row row-cols-1 row-cols-md-4 g-4 mt-3">
                        @foreach($leading_articles as $leading)
                            <div class="col">
                                <div class="card h-100 icon-box" style="border:none;">
                                    <a href="{{ route('site.article.full.show', $leading->slug) }}">
                                        <div class="">
                                            <img src="/article_covers/{{ $leading->image }}" class="card-img-top" alt="..." height="150">
                                        </div>
                                        <div class="card-body background-black">
                                            <h5 class="card-title">
                                                <a class="text-warning" href="{{ route('site.article.full.show', $leading->slug) }}">{{ $leading->title }}</a>
                                            </h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                {{--                </div>--}}

            </div>
        </div>
    </section>
    <!--- end french lead stories section---->

    <!----editorial article section---->
    <section id="editorial-section">
        <div class="container">

            <h2 class="text-center">Renaissance de l’industrialisation en Afrique, l’heure est venue </h2>
            <p>
            <div class="text-center">
                <img src="/article_covers/editorial.jpg" alt="" class="img-fluid">
            </div>
            <div  class="mt-2">
                L’Afrique produit ce qu’elle ne consomme pas et consomme ce qu’elle ne produit pas.
                Intéressant sur le plan factuel. Ce paradoxe explique les niveaux massifs de pauvreté et
                le manque d’emplois dans presque tous les pays africains.
            </div>
            <div  class="mt-2">
                L’industrialisation est le processus par lequel une économie passe d’une production
                essentiellement agraire à des biens et services produits en masse et technologiquement
                avancés. Cette phase se caractérise par des sauts exponentiels de productivité dans des
                volumes élevés de meilleure qualité, en moins de temps et à un coût bien moindre.
                En termes simples, il s’agit d’une période de transformation d’une économie agricole
                en une économie urbaine de production de masse. Le travail manuel individuel est
                souvent remplacé par une production de masse mécanisée et les artisans sont remplacés
                par des chaînes de montage. Ce n’est jamais un processus sans heurts, mais c’est un pari
                sûr pour échapper à la pauvreté et créer de la richesse, des emplois, etc.
            </div>
            <div  class="mt-2">
                L’Afrique ne représente qu’une maigre part de 1,5 % de la production manufacturière
                mondiale totale. La comparaison est mauvaise avec l’Asie et le Pacifique (21 %),
                l’Asie de l’Est (17 %), l’Europe (24 %) et l’Amérique du Nord (22 %).
            </div>

            <div  class="mt-2">
                Des statistiques documentées montrent qu’environ 60% des terres arables non cultivées
                du monde se trouvent en Afrique. Cela signifie que si les Africains relevaient leurs
                manches, se serraient la ceinture pour travailler la terre, la mécaniser, l’irriguer,
                l’Afrique pourrait facilement dicter les prix alimentaires mondiaux. En dépit de ces
                faits, l’Afrique dépense plus de 30 milliards de dollars par an pour importer des produits
                alimentaires qu’elle devrait essentiellement exporter.  L’Afrique est censée être un
                exportateur net de produits alimentaires. Si rien n’est fait pour remédier à cette situation,
                la facture annuelle des importations alimentaires devrait atteindre 100 milliards de dollars d’ici 2025.
            </div>

            <div  class="mt-2">
                En outre, environ 30 % des réserves minérales mondiales se trouvent en Afrique. Les réserves prouvées
                de pétrole du continent constituent 8 % du stock mondial, tandis que celles de gaz naturel
                s’élèvent à 7 % du stock mondial. Intéressant car malgré ces statistiques, l’Afrique est un importateur
                net de tout, sauf d’oxygène et de matières premières.
            </div>

            <div  class="mt-2">
                D’ici 2030, les jeunes Africains devraient représenter 42 % de la jeunesse mondiale et 75 % des moins
                de 35 ans en Afrique. Actuellement, environ 226 millions de jeunes âgés de 15 à 24 ans vivent en Afrique,
                ce qui représente près de 20 % de la population africaine et un cinquième de la population mondiale des
                jeunes. L’Afrique dispose d’une main-d’œuvre classique et énergique !

            </div>
            <div  class="mt-2">
                En résumé, l’Afrique a tous les ingrédients pour un décollage industriel.  L’Afrique doit relier les secteurs
                de l’agriculture, de l’industrie et des services. Elle doit concentrer ses énergies et ses ressources sur un
                domaine où elle dispose d’un avantage comparatif potentiel important, l’agro-industrialisation. L’Afrique
                doit transformer tout ce qu’elle produit et déplacer une main-d’œuvre jeune et massive vers des secteurs plus
                productifs de l’économie, à savoir l’industrie manufacturière.
            </div>
            <div  class="mt-2">
                Ce n’est qu’alors que l’industrialisation pourra percoler et changer définitivement le paysage économique de
                cette belle patrie.  Ce n’est qu’à ce moment-là que les économies africaines, historiquement dirigées par
                les prix imprévisibles des matières premières, pourront commencer à se stabiliser. Ce n’est qu’alors que
                les Africains pourront exploiter les possibilités offertes par la Zone de libre-échange du continent africain
                (ZLECA), établie plus récemment. Ce n’est qu’alors que les Africains pourront gérer leur balance commerciale
                et transformer le continent en un lieu d’espoir pour les jeunes et un foyer pour les investissements directs étrangers.
            </div>
            <div  class="mt-2">
                Le temps est venu, l’heure est venue de réaliser notre rêve commun d’une Afrique industrialisée et d’entreprendre le voyage de l’Agenda 2063.
            </div>
            <div  class="mt-2">
                FirstCode Corporation catalyse ce rêve insaisissable d’industrialisation de l’Afrique à partir de positions
                multiples, des médias à la technologie. Cela semble toujours impossible, jusqu’à ce que ce soit fait,
                disait Nelson Mandela. L’heure est venue.

            </div>

            <div class="text-end">
                Eng. Jorge Forester,<br>
                <strong> Rédacteur en Chef</strong>
            </div>
            </p>
            <div class="text-center mt-2">
                <button class="btn put-gold" style="background-color: black; box-shadow: 0 0 30px goldenrod;">
                    <a class="nav-link ml-4 put-gold text-uppercase" href="{{ route('show.register') }}">Read Current Edition</a>
                </button>
            </div>
        </div>
    </section>

    <!----end editorial article section---->
@endsection
