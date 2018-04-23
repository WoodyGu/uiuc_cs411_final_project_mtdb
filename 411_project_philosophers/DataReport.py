
import matplotlib
matplotlib.use('Agg')
import matplotlib.pyplot as plt
import numpy as np
import pandas as pd
import math

COLORS = ["red", "indigo","orange", "yellow", "lightblue", "chocolate", "fuchsia","green", "pink", "blue", "purple", "khaki", "black", "grey", "coral","aqua", "gold", "lavender", "lime"]

class EvaluationByTime(object):
    def __init__(self, diag, y_values, y_ticks, y_label=None, x_values=None, x_ticks=None, x_label=None, title=None, explode=None):
        '''
        Args:
            diag: which kind of diagram does user want, plot or pie
            cates: y_values, 2d list,  each row is a list consists of gene name(string) and its values(double)

            gener: x_values, a list of generation (years) which is x-axis
        '''
        self.diag = diag
        self.y_values = y_values
        self.y_label = y_label
        self.y_ticks = y_ticks
        self.x_values = x_values
        self.x_label = x_label
        self.x_ticks = x_ticks
        self.title = title
        self.explode = explode


    @staticmethod
    def bar_evaluate(y_values, y_ticks, y_label, x_values, x_ticks, x_label, title): # sc, sqlContext):
        '''
        Args:
            sc: The Spark Context
            sqlContext: The Spark SQL context
        Returns:
            A list: the total number of crimes by hour
        '''
        # plt.figure(figsize=(20,15))
        # plt.bar(x_values, y_values, align='center')
        # plt.yticks(y_values)
        # plt.xticks(x_values, x_ticks, rotation='vertical')
        # plt.xlabel(x_label)
        # plt.ylabel(y_label)
        # plt.title("Movie from Different Countries " + y_label + " V.S. " + x_label)
        # plt.savefig("bar_test.png")
        if y_label == "box_office":
            ln_y_values = [math.log(x) for x in y_values]
            y_label = "ln(box_office)"
            freq_series = pd.Series.from_array(ln_y_values)
        else:
            freq_series = pd.Series.from_array(y_values)
        plt.figure(figsize=(20, 10))
        if y_label == "popularity":
            plt.subplots_adjust(top=0.8,bottom=0.35)
        else:
            plt.subplots_adjust(top=0.8,bottom=0.25)
        ax = freq_series.plot(kind='bar')
        ax.set_title("Movies Contrast by Countries " + "\n" + title["y_label"] + " V.S. " + title["x_label"] + "\n" + "(" + str(title["from_year"]) + " ~ " + str(title["to_year"]) + ")")
        ax.set_xlabel(x_label)
        ax.set_ylabel(y_label)
        ax.set_xticklabels(x_ticks,rotation='vertical')

        rects = ax.patches

        # Make some labels.
        # labels = ["label%d" % i for i in range(len(rects))]
        if len(x_ticks) <= 10:
            rotate = "horizontal"
        else:
            rotate = "vertical"
        if y_label == "ln(box_office)":
            add_height = 2
        elif y_label == "popularity":
            add_height = 0.5
        else:
            add_height = 5

        for rect, label in zip(rects, y_values):
            height = rect.get_height()
            ax.text(rect.get_x() + rect.get_width() / 2, height + add_height, label,
                    ha='center', va='bottom',rotation=rotate)
        name = str(np.random.randint(0, 100000000)) + ".png"
        plt.savefig(name)
        print(name)

    @staticmethod
    def plot_evaluate(y_values, y_ticks, y_label, x_values, x_ticks, x_label, title):
        plt.plot(x_values, y_values, 'r-')
        plt.xticks(x_values, x_ticks)
        plt.xlabel(x_label)
        plt.ylabel(y_label)
        plt.title(title["y_label"] + " V.S. " + title["x_label"] + " of " + title["cate_intg"] + " Movie" + "\n(" + str(title["from_year"]) + " ~ " + str(title["to_year"]) + ")")
        name = str(np.random.randint(0, 100000000)) + ".png"
        plt.savefig(name)
        print(name)


    @staticmethod
    def pie_evaluate(y_values, y_ticks, y_label, title, explode):
        # explode = (0, 0.1, 0, 0)  # only "explode" the 2nd slice (i.e. 'Hogs')
        # fig1, ax1 = plt.subplots()
        # labels = []
        # for i in range(len(y_values):
        #     label =
        # ax1.pie(y_values, labels=y_ticks, autopct='%1.1f%%',
        #         shadow=True, startangle=90)
        # ax1.axis('equal')  # Equal aspect ratio ensures that pie is drawn as a circle.
        # plt.title("Category Contrast")
        # plt.savefig("test3.png")
        #######
        the_sum = sum(y_values)
        labels = []
        for i in range(len(y_values)):
            label = y_ticks[i] + ": " + str(round(y_values[i])) + " (" + str(round(100 * y_values[i]/the_sum, 3)) + "%)"
            labels.append(label)
        plt.figure(figsize=(15,10))
        # print("explode:{}".format(explode))
        if len(explode) == 0:
            patches, texts = plt.pie(y_values, colors=COLORS,startangle=90)
        else:
            patches, texts = plt.pie(y_values,explode=explode,colors=COLORS,startangle=90)
        plt.legend(patches, labels, loc="best")
        plt.axis('equal')  # Equal aspect ratio ensures that pie is drawn as a circle.
        plt.tight_layout()
        if title["cate_intg"] == "All":
            plt.title("Movie Category Contrast in " + title["y_label"] + "\n(" + str(title["from_year"]) + " ~ " + str(title["to_year"]) + ")")
        else:
            plt.title("Movie Category Contrast in " + title["y_label"] + "\n(" + str(title["from_year"]) + " ~ " + str(title["to_year"]) + ")" + "\n Search Result for " + title["cate_intg"])
        plt.subplots_adjust(top=0.85)

        name = str(np.random.randint(0, 100000000)) + ".png"
        plt.savefig(name)
        print(name)
        #######
        # labels = [r'Rayos X (88.4 %)', r'RMN en solucion (10.6 %)', \
        #           r'Microscopia electronica (0.7 %)', r'Otros (0.3 %)']
        # sizes = [88.4, 10.6, 0.7, 0.3]
        # colors = ['yellowgreen', 'gold', 'lightskyblue', 'lightcoral']
        # patches, texts = plt.pie(sizes, colors=colors, startangle=90)
        # plt.legend(patches, labels, loc="best")
        # # Set aspect ratio to be equal so that pie is drawn as a circle.
        # plt.axis('equal')
        # plt.tight_layout()
        # plt.show()


    def create_graph(self):
        if self.diag == "bar":
            EvaluationByTime.bar_evaluate(self.y_values, self.y_ticks, self.y_label, self.x_values, self.x_ticks, self.x_label, self.title)
        elif self.diag == "pie":
            EvaluationByTime.pie_evaluate(self.y_values, self.y_ticks, self.y_label, self.title, self.explode)
        elif self.diag == "plot":
            EvaluationByTime.plot_evaluate(self.y_values, self.y_ticks, self.y_label, self.x_values, self.x_ticks, self.x_label, self.title)
